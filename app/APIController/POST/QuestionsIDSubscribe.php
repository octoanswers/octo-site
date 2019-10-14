<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDSubscribe extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');
            $question_id = (int) $request->getAttribute('id');

            $post_params = $request->getParsedBody();
            $email = (string) $post_params['email'];
            $is_sendEmail = $post_params['no_email'] ? false : true;

            $this->lang = $lang;

            //
            // Validate params
            //

            $question = (new \Query\Question($this->lang))->questionWithID($question_id);
            \Validator\User::validateEmail($email); // @TODO Need?

            //
            // Check already subscribed
            //

            $s = (new \Query\Subscriptions($this->lang))->findWithQuestionIDAndEmail($question_id, $email);
            if ($s != null) {
                throw new \Exception('Email "' . $email . '" already subscribed to question with ID ' . $question_id, 0);
            }

            //
            // Save subscription in DB
            //

            $subscription = new \Model\Subscription();
            $subscription->questionID = $question_id;
            $subscription->email = $email;
            $subscription = (new \Mapper\Subscription($this->lang))->create($subscription);

            //
            // Send email
            //

            if ($is_sendEmail) {
                $mailer = new \Helper\Mailer\Subscription();
                $mailer->sendEmail($email, $question);
            }

            $output = [
                'lang'               => $this->lang,
                'question_id'        => $question->id,
                'question_title'     => $question->title,
                'question_url'       => $question->getURL($this->lang),
                'subscription_id'    => $subscription->id,
                'subscription_email' => $subscription->email,
            ];
        } catch (\Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
