<?php

require_once '../header.action.php';

use Parse\ParseException;
use Parse\ParseUser;

$errors = [];
$response = [];

// пропускаем только AJAX-запросы
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $currentUser = ParseUser::getCurrentUser();

    // Валидиация данных ==========================================================

    if (!$currentUser) {
        $errors['other'] = 'User not logged.';
    }

    $query = ParseUser::query();

    try {
        $parseUser = $query->get($currentUser->getObjectId());
        if (!$parseUser) {
            throw new ParseException('User not found by ID: ' . $currentUser->getObjectId());
        }
    } catch (ParseException $ex) {
        $errors['other'] = $ex->getMessage();
    }

    // Возвращаем ответ ==========================================================

    if (!empty($errors)) {
        $response['success'] = false;
        $response['errors'] = $errors;
    } else {
        try {
            $currentUserEmail = $parseUser->email;
            $response['data']['currentUserEmail'] = $currentUserEmail;

            //TODO: В спам не попадем из-за таких рассылок?
            $fakeUserEmail = 'no-reply@qusoc.com';
            $response['data']['fakeUserEmail'] = $fakeUserEmail;

            $parseUser->email = $fakeUserEmail;
            $parseUser->save();

            $parseUser->email = $currentUserEmail;
            $parseUser->save();

            $response['success'] = true;
        } catch (ParseException $ex) {
            $errors['other'] = 'Error: ' . $ex->getCode() . ' ' . $ex->getMessage();
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
