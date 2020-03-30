<?php

namespace Helper\Mailer;

class Subscription extends \Helper\Mailer\Mailer
{
    public function sendEmail(string $to_email, \Model\Question $question)
    {
        $subject = 'Вы подписались на вопрос «'.$question->title.'»';

        $message = '<p>Вы подписались на вопрос <a href="#">'.$question->title.'</a>.</p>';
        $message .= '<p>Социальная сеть вопросов и ответов, <a href="https://answeropedia.org">Answeropedia</a>:</p>';

        $this->sendTextEmail($to_email, $subject, $message);
    }
}
