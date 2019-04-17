<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class QuestionsIDFollow_DELETE_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            
            $api_key = (string) $request->getParam('api_key');
            $questionID = (int) $args['id'];

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->getID();

            $question = (new Question_Query($this->lang))->questionWithID($questionID);

            $relation = (new UsersFollowQuestions_Relations_Query($this->lang))->relationWithUserIDAndQuestionID($userID, $questionID);
            if (!$relation) {
                throw new Exception('User with ID "'.$userID.'" not followed question with ID "'.$questionID.'"', 0);
            }

            #
            # Delete follow record
            #

            (new UserFollowQuestion_Relation_Mapper($this->lang))->deleteRelation($relation);

            $output = [
                'user_id' => $user->getID(),
                'user_name' => $user->name,
                'followed_question_id' => $question->getID(),
                'followed_question_title' => $question->title,
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
