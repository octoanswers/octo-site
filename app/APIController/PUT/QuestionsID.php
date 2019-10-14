<?php

namespace APIController\PUT;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsID extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');
            $question_ID = (int) $request->getAttribute('id');

            $query_params = $request->getQueryParams();
            $question_title = (string) $query_params['question_title'];

            \Validator\Question::validateID($question_ID);

            // check API-key
            // if ($check_api_key) {
            //     $api_key = \Validator\User::validateRequiredApiKey(@$request->getAttribute('api_key'));
            //     $user = $api->get('users_api_key', ['api_key' => $api_key]);
            //
            //     // only moderators can modify questions data
            //     // check, that user is owned question?
            //     // $user['id'] ==
            // }

            $question = (new \Query\Question($lang))->questionWithID($question_ID);
            $question->title = $question_title;

            $question = (new \Mapper\Question($lang))->update($question);

            $output = [
                'id'          => $question->id,
                'title'       => $question->title,
                'url'         => $question->getURL($lang),
                'is_redirect' => $question->isRedirect,
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
