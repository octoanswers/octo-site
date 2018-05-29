<?php
/*******************************
 * Экшн убирающий лайк с ответа.
 *******************************/

require_once 'header.action.php';

use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseException;

$errors = array();
$response = array();

// пропускаем только AJAX-запросы
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $currentUser = ParseUser::getCurrentUser();

    // Валидиация данных ==========================================================

  if (!$currentUser) {
      $errors['other'] = 'Необходимо войти, что бы отменить лайк ответа';
  }

    if (!$_POST['answer-id']) {
        $errors['other'] = 'Вы пытаетесь отменить лайк не существующего ответа';
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

      // if like-object not found, throw exception
      $likeQuery = new ParseQuery('Like');
          $likeQuery->equalTo('user', $currentUser);
          $likeQuery->equalTo('likeAnswer', $parseAnswer);
          $likeAnswer = $likeQuery->first();
          if (!$likeAnswer) {
              throw new ParseException('Answer '.$_POST['answer-id'].' already liked by user: '.$currentUser->getObjectId());
          }

            // If allready OK, drop like-object ======================================

            $likeAnswer->destroy();

            // Decrement "likesCount" property

            $likedByArray = $parseAnswer->get('likedBy');
          if (($key = array_search($currentUser->getObjectId(), $likedByArray)) !== false) {
              unset($likedByArray[$key]);
          }
          $parseAnswer->setArray('likedBy', $likedByArray);
          $parseAnswer->increment('likesCount', -1);
          $parseAnswer->save(true);

          $response['success'] = true;
          $response['message'] = 'Ответ дислайкнут успешно!';
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
