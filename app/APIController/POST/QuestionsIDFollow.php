<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDFollow extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');
            $question_id = (int) $request->getAttribute('id');

            $post_params = $request->getParsedBody();
            $api_key = (string) $post_params['api_key'];

            //
            // Validate params
            //

            $user = (new \Query\User())->userWithAPIKey($api_key);

            $question = (new \Query\Question($lang))->questionWithID($question_id);

            $relation = (new \Query\Relations\UsersFollowQuestions($lang))->relationWithUserIDAndQuestionID($user->id, $question->id);
            if ($relation) {
                throw new \Exception('User with ID "'.$user->id.'" already followed question with ID "'.$question->id.'"', 0);
            }

            //
            // Save follow relation
            //

            $relation = new \Model\Relation\UserFollowQuestion();
            $relation->userID = $user->id;
            $relation->questionID = $question->id;

            $relation = (new \Mapper\Relation\UserFollowQuestion($lang))->create($relation);

            //
            // Create activity
            //

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::F_U_FOLLOW_Q;
            $activity->subject = $user;
            $activity->data = $question;

            $activity = (new \Mapper\Activity\UFollowQ($lang))->create($activity);

            $output = [
                'lang'                    => $lang,
                'relation_id'             => $relation->id,
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
