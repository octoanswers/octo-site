<?php

function send_email($to_email, $subject, $message)
{
    $header = 'From: OctoAnswers <no_reply@octoanswers.com>'."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=UTF-8\r\n";

    // send email

    $sent = mail($to_email, $subject, $message, $header);
    if (!$sent) {
        $errorMessage = "Server couldn't send the email.";
        throw new Exception($errorMessage);
    } else {
        return true;
    }
}
