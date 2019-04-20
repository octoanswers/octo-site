<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class QuestionsID_PUT_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $questionID = (int) $args['id'];
            $questionTitle = (string) $request->getParam('question_title');

            Question_Validator::validateID($questionID);

            // check API-key
            // if ($check_api_key) {
            //     $api_key = User_Validator::validateRequiredApiKey(@$args['api_key']);
            //     $user = $api->get('users_api_key', ['api_key' => $api_key]);
            //
            //     // only moderators can modify questions data
            //     // check, that user is owned question?
            //     // $user['id'] ==
            // }

            $question = (new Question_Query($this->lang))->questionWithID($questionID);
            $question->title = $questionTitle;

            $question = (new Question_Mapper($this->lang))->update($question);

            $output = [
                'id' => $question->id,
                'title' => $question->title,
                'url' => $question->getURL($this->lang),
                'is_redirect' => $question->isRedirect,
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
