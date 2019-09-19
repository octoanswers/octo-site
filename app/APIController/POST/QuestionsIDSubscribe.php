<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDSubscribe_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $question_id = (int) $args['id'];
            $email = (string) $request->getParam('email');
            $is_send_email = $request->getParam('no_email') ? false : true;

            //
            // Validate params
            //

            $question = (new Question_Query($this->lang))->question_with_ID($question_id);
            User_Validator::validateEmail($email); // @TODO Need?

            //
            // Check already subscribed
            //

            $s = (new Subscriptions_Query($this->lang))->find_with_question_ID_and_email($question_id, $email);
            if ($s != null) {
                throw new \Exception('Email "' . $email . '" already subscribed to question with ID ' . $question_id, 0);
            }

            //
            // Save subscription in DB
            //

            $subscription = new \Model\Subscription();
            $subscription->questionID = $question_id;
            $subscription->email = $email;
            $subscription = (new Subscription_Mapper($this->lang))->create($subscription);

            //
            // Send email
            //

            if ($is_send_email) {
                $mailer = new SubscriptionMailer();
                $mailer->sendEmail($email, $question);
            }

            $output = [
                'lang'               => $this->lang,
                'question_id'        => $question->id,
                'question_title'     => $question->title,
                'question_url'       => $question->get_URL($this->lang),
                'subscription_id'    => $subscription->id,
                'subscription_email' => $subscription->email,
            ];
        } catch (Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
