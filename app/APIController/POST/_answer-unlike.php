<?php

require_once 'header.action.php';

use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseException;

$errors = array();
$response = array();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $currentUser = ParseUser::getCurrentUser();

    if (!$currentUser) {
        $errors['other'] = _('API__ERROR__NEED_LOGIN_TO_DISLIKE_ANSWER');
    }

    if (!$_POST['answer-id']) {
        $errors['other'] = _('API__ERROR__ANSWER_LIKE_NOT_EXISTS');
    }

    if (!empty($errors)) {
        $response['success'] = false;
        $response['errors'] = $errors;
    } else {
        try {

            // _checkQuestionWithID
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
            $response['message'] = _('API__OK__ANSWER_DISLIKED');
        } catch (ParseException $ex) {
            $errors['other'] = _('API__ERROR').': '.$ex->getCode().' '.$ex->getMessage();
            $response['success'] = false;
            $response['errors'] = $errors;
        }
    }
} else {
    $errors['other'] = _('API__ERROR__ONLY_AJAX');
    $response['success'] = false;
    $response['errors'] = $errors;
}

echo json_encode($response);
