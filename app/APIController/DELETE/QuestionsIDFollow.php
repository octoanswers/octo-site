<?php

namespace APIController\DELETE;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDFollow extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');
            $question_ID = (int) $request->getAttribute('id');

            $query_params = $request->getQueryParams();
            $api_key = (string) $query_params['api_key'];

            $this->lang = $lang;

            //
            // Validate params
            //

            $user = (new \Query\User())->userWithAPIKey($api_key);

            $question = (new \Query\Question($this->lang))->questionWithID($question_ID);

            $relation = (new \Query\Relations\UsersFollowQuestions($this->lang))->relationWithUserIDAndQuestionID($user->id, $question_ID);
            if (!$relation) {
                throw new \Exception('User with ID "' . $user->id . '" not followed question with ID "' . $question_ID . '"', 0);
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
