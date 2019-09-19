<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsID_PUT_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $question_ID = (int) $args['id'];
            $question_title = (string) $request->getParam('question_title');

            \Validator\Question::validateID($question_ID);

            // check API-key
            // if ($check_api_key) {
            //     $api_key = \Validator\User::validateRequiredApiKey(@$args['api_key']);
            //     $user = $api->get('users_api_key', ['api_key' => $api_key]);
            //
            //     // only moderators can modify questions data
            //     // check, that user is owned question?
            //     // $user['id'] ==
            // }

            $question = (new Question_Query($this->lang))->question_with_ID($question_ID);
            $question->title = $question_title;

            $question = (new \Mapper\Question($this->lang))->update($question);

            $output = [
                'id'          => $question->id,
                'title'       => $question->title,
                'url'         => $question->get_URL($this->lang),
                'is_redirect' => $question->isRedirect,
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
