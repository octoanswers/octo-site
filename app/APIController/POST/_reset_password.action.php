<?php

require_once '../header.action.php';

use Parse\ParseUser;
use Parse\ParseException;

$errors = array();
$response = array();

// Get only AJAX-queries
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $currentUser = ParseUser::getCurrentUser();

    if ($currentUser) {
        $errors['email'] = 'Перед сбросом пароля необходимо выйти из системы.';
    }

    $query = ParseUser::query();
    $query->equalTo('email', $_POST['user_email']);
    try {
        $parseUser = $query->first();
        if (!$parseUser) {
            throw new ParseException('User not found by email: '.$_POST['user_email']);
        }
    } catch (ParseException $ex) {
        $errors['email'] = 'Error: '.$ex->getMessage();
    }

    if (empty($_POST['user_email'])) {
        $errors['email'] = 'Email is required.';
    }

    if (!empty($errors)) {
        $response['success'] = false;
        $response['errors'] = $errors;
    } else {
        try {
            ParseUser::requestPasswordReset($_POST['user_email']);

            // Password reset request was sent successfully
            $response['success'] = true;
        } catch (ParseException $ex) {
            $errors['email'] = 'Error: '.$ex->getCode().' '.$ex->getMessage();
            $response['success'] = false;
            $response['errors'] = $errors;
        }
    }
} else {
    $errors['other'] = 'Обрабатываются только AJAX-запросы.';
    $response['success'] = false;
    $response['errors'] = $errors;
}

// return all our data to an AJAX call
echo json_encode($response);
