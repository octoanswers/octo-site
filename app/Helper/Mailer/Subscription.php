<?php

class SubscriptionMailer extends AbstractMailer
{
    public function sendEmail(string $to_email, Question_Model $question)
    {
        $subject = 'Вы подписались на вопрос «'.$question->getTitle().'»';

        $message = '<p>Вы подписались на вопрос <a href="#">'.$question->getTitle().'</a>.</p>';
        $message .= '<p>Социальная сеть вопросов и ответов, <a href="https://answeropedia.org">Answeropedia</a>:</p>';

        $this->send_email($to_email, $subject, $message);
    }
}
