<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDFollow_DELETE_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $api_key = (string) $request->getParam('api_key');
            $question_ID = (int) $args['id'];

            //
            // Validate params
            //

            $user = (new \Query\User())->user_with_API_key($api_key);

            $question = (new \Query\Question($this->lang))->question_with_ID($question_ID);

            $relation = (new \Query\Relations\UsersFollowQuestions($this->lang))->relation_with_user_ID_and_question_ID($user->id, $question_ID);
            if (!$relation) {
                throw new Exception('User with ID "' . $user->id . '" not followed question with ID "' . $question_ID . '"', 0);
            }

            //
            // Delete follow record
            //

            (new \Mapper\Relation\UserFollowQuestion($this->lang))->delete_relation($relation);

            $output = [
                'user_id'                 => $user->id,
                'user_name'               => $user->name,
                'followed_question_id'    => $question->id,
                'followed_question_title' => $question->title,
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
