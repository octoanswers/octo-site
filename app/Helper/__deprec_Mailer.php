<?php
/*
 * Mailer for Answeropedia
 */

class Mailer
{
    private $moderatorEmail = 'alexander.gomzyakov@gmail.com';

    public $toEmail = null;

    public $questionId = null;
    public $questionTitle = null;
    public $questionOwnerUsername = null;
    public $questionOwnerRealName = null;
    public $questionFormattedDescription = null;

    public $answerFormattedText = null;
    public $answerOwnerUsername = null;
    public $answerOwnerRealName = null;

    public $followerUsername = null;
    public $followerRealName = null;
    public $followerAvatarUrl = null;

    public function sendEmailToFollowedUser()
    {
        if (is_null($this->toEmail)) {
            throw new \Exception('Email is empty.');
        }

        $subject = 'Вас добавили в друзья на Answeropedia';

        $message = '<p>Пользователь <a href="https://answeropedia.org/' . $this->followerUsername . '">' . $this->followerRealName . '</a> добавил вас в друзья.</p>';
        $message .= '<p>Социальная сеть вопросов и ответов, <a href="https://answeropedia.org">' . SITE_NAME . '</a>:</p>';

        $this->sendEmail($subject, $message);
    }

    public function sendEmailAboutNewAnswer()
    {
        if (is_null($this->toEmail)) {
            throw new \Exception('Email is empty.');
        }

        $subject = 'Вы получили новый ответ на Answeropedia';

        $message = '<p>Пользователь <a href="https://answeropedia.org/' . $this->answerOwnerUsername . '">' . $this->answerOwnerRealName . '</a> ответил на ваш вопрос: <a href="https://answeropedia.org/ru/' . $this->questionId . '">' . $this->questionTitle . '</a></p>';
        $message .= '<p><em>Ответ:</em></p>';
        $message .= $this->answerFormattedText;
        $message .= '<p>Социальная сеть вопросов и ответов, <a href="https://answeropedia.org">Answeropedia</a>:</p>';

        $this->sendEmail($subject, $message);
    }

    public function sendEmailToMentionedUser()
    {
        if (is_null($this->toEmail)) {
            throw new \Exception('Email is empty.');
        }

        $subject = 'Вам задали новый вопрос на Answeropedia';

        $message = '<p>Пользователь <a href="https://answeropedia.org/' . $this->questionOwnerUsername . '">' . $this->questionOwnerRealName . '</a> задал вам вопрос:</p>';
        $message .= '<p><a href="https://answeropedia.org/ru/' . $this->questionId . '">' . $this->questionTitle . '</a></p>';
        $message .= $this->questionFormattedDescription;
        $message .= '<p>Социальная сеть вопросов и ответов, <a href="https://answeropedia.org">Answeropedia</a>:</p>';

        $this->sendEmail($subject, $message);
    }

    private function send_email($subject, $message)
    {
        $header = 'From: Answeropedia <no_reply@answeropedia.org>' . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=UTF-8\r\n";

        // send email

        $sent = mail($this->toEmail, $subject, $message, $header);
        if (!$sent) {
            $errorMessage = "Server couldn't send the email.";

            throw new \Exception($errorMessage);
        } else {
            return true;
        }
    }
}
