<?php

require_once 'header.action.php';

use Parse\ParseUser;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParseException;

$errors = array();
$response = array();

// пропускаем только AJAX-запросы
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $currentUser = ParseUser::getCurrentUser();

    // Валидиация данных ==========================================================

  if (!$currentUser) {
      $errors['other'] = 'Необходимо войти, что бы залайкать ответ';
  }

    if (!$_POST['answer-id']) {
        $errors['other'] = 'Вы пытаетесь лайкнуть не существующий ответ';
    }

  // Возвращаем ответ ==========================================================

  if (!empty($errors)) {
      $response['success'] = false;
      $response['errors'] = $errors;
  } else {
      try {
          // Проверка данных и логики ==============================================

      // если ответ с заданным id не найден, продолжать смысла нет
      $query = new ParseQuery('Answer');
          $parseAnswer = $query->get($_POST['answer-id']);
          if (!$parseAnswer) {
              throw new ParseException('Not found answer by ID: '.$_POST['answer-id']);
          }

      //  если пользователь уже лайкал этот ответ, закругляемся
      $likeQuery = new ParseQuery('Like');
          $likeQuery->equalTo('user', $currentUser);
          $likeQuery->equalTo('likeAnswer', $parseAnswer);
          $answerLike = $likeQuery->first();
          if ($answerLike) {
              throw new ParseException('Answer '.$_POST['answer-id'].' already liked by user: '.$currentUser->getObjectId());
          }

            // Всё ок ================================================================

            // создаем Like-объект
            $likeAnswer = new ParseObject('Like');
          $likeAnswer->set('type', 'likeAnswer');
          $likeAnswer->set('user', $currentUser);
          $likeAnswer->set('likeAnswer', $parseAnswer);
          $acl = new ParseACL();
          $acl->setUserWriteAccess($currentUser, true);
          $acl->setPublicReadAccess(true);
          $acl->setPublicWriteAccess(false);
          $likeAnswer->setACL($acl);
          $likeAnswer->save();

          $likedByArray = $parseAnswer->get('likedBy');
          $likedByArray[] = $currentUser->getObjectId();
          $parseAnswer->setArray('likedBy', $likedByArray);
          $parseAnswer->increment('likesCount');
          $parseAnswer->save(true);

          $response['success'] = true;
          $response['message'] = 'Ответ лайкнут успешно!';
      } catch (ParseException $ex) {
          $errors['other'] = 'Ошибка: '.$ex->getCode().' '.$ex->getMessage();
          $response['success'] = false;
          $response['errors'] = $errors;
      }
  }
} else {
    // запрос был отправлен не средствами AJAX
  $errors['other'] = 'Обрабатываются только AJAX-запросы.';
    $response['success'] = false;
    $response['errors'] = $errors;
}

echo json_encode($response);
