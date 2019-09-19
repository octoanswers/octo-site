<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDFollow_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $api_key = (string) $request->getParam('api_key');
            $question_id = (int) $args['id'];

            //
            // Validate params
            //

            $user = (new \Query\User())->user_with_API_key($api_key);

            $question = (new \Query\Question($this->lang))->question_with_ID($question_id);

            $relation = (new \Query\Relations\UsersFollowQuestions($this->lang))->relation_with_user_ID_and_question_ID($user->id, $question->id);
            if ($relation) {
                throw new Exception('User with ID "' . $user->id . '" already followed question with ID "' . $question->id . '"', 0);
            }

            //
            // Save follow relation
            //

            $relation = new \Model\Relation\UserFollowQuestion();
            $relation->userID = $user->id;
            $relation->questionID = $question->id;

            $relation = (new \Mapper\Relation\UserFollowQuestion($this->lang))->create($relation);

            //
            // Create activity
            //

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::F_U_FOLLOW_Q;
            $activity->subject = $user;
            $activity->data = $question;

            $activity = (new \Mapper\Activity\UFollowQ($this->lang))->create($activity);

            $output = [
                'lang'                    => $this->lang,
                'relation_id'             => $relation->id,
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
