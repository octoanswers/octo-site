<?php

require_once 'header.action.php';

use Parse\ParseACL;
use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseUser;

$errors = [];
$response = [];

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $currentUser = ParseUser::getCurrentUser();

    if (!$currentUser) {
        $errors['other'] = 'API Error: Need login to like answer';
    }

    if (!$_POST['answer-id']) {
        $errors['other'] = 'API Error: Answer already liked';
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

            //  _isUserAlreadyLikedAnswer
            $likeQuery = new ParseQuery('Like');
            $likeQuery->equalTo('user', $currentUser);
            $likeQuery->equalTo('likeAnswer', $parseAnswer);
            $answerLike = $likeQuery->first();
            if ($answerLike) {
                throw new ParseException('Answer '.$_POST['answer-id'].' already liked by user: '.$currentUser->getObjectId());
            }

            // _createLikeEntity
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
            $response['message'] = 'API: Answer liked';
        } catch (ParseException $ex) {
            $errors['other'] = 'API Error'.': '.$ex->getCode().' '.$ex->getMessage();
            $response['success'] = false;
            $response['errors'] = $errors;
        }
    }
} else {
    $errors['other'] = 'API Error: Only AJAX requests';
    $response['success'] = false;
    $response['errors'] = $errors;
}

echo json_encode($response);
