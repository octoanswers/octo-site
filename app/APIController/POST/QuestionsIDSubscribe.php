<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class QuestionsIDSubscribe_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            
            $question_id = (int) $args['id'];
            $email = (string) $request->getParam('email');
            $is_send_email = $request->getParam('no_email') ? false : true;

            #
            # Validate params
            #

            $question = (new Question_Query($this->lang))->questionWithID($question_id);
            User_Validator::validateEmail($email); // @TODO Need?

            #
            # Check already subscribed
            #

            $s = (new Subscriptions_Query($this->lang))->findWithQuestionIDAndEmail($question_id, $email);
            if ($s != null) {
                throw new \Exception('Email "'.$email.'" already subscribed to question with ID '.$question_id, 0);
            }

            #
            # Save subscription in DB
            #

            $subscription = new Subscription_Model();
            $subscription->setQuestionID($question_id);
            $subscription->setEmail($email);
            $subscription = (new Subscription_Mapper($this->lang))->create($subscription);

            #
            # Send email
            #

            if ($is_send_email) {
                $mailer = new SubscriptionMailer();
                $mailer->sendEmail($email, $question);
            }

            $output = [
                'lang' => $this->lang,
                'question_id' => $question->getID(),
                'question_title' => $question->getTitle(),
                'question_url' => $question->getURL($this->lang),
                'subscription_id' => $subscription->getID(),
                'subscription_email' => $subscription->getEmail(),
            ];
        } catch (Throwable $e) {
            $output = [
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
