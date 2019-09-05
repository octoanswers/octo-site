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

            $user = (new User_Query())->user_with_API_key($api_key);

            $question = (new Question_Query($this->lang))->question_with_ID($question_id);

            $relation = (new UsersFollowQuestions_Relations_Query($this->lang))->relation_with_user_ID_and_question_ID($user->id, $question->id);
            if ($relation) {
                throw new Exception('User with ID "' . $user->id . '" already followed question with ID "' . $question->id . '"', 0);
            }

            //
            // Save follow relation
            //

            $relation = new UserFollowQuestion_Relation_Model();
            $relation->userID = $user->id;
            $relation->questionID = $question->id;

            $relation = (new UserFollowQuestion_Relation_Mapper($this->lang))->create($relation);

            //
            // Create activity
            //

            $activity = new Activity_Model();
            $activity->type = Activity_Model::F_U_FOLLOW_Q;
            $activity->subject = $user;
            $activity->data = $question;

            $activity = (new UFollowQ_Activity_Mapper($this->lang))->create($activity);

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
