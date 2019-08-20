<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDFollow_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $api_key = (string) $request->getParam('api_key');
            $followedUserID = (int) $args['id'];

            //
            // Validate params
            //

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->id;

            $followed_user = (new User_Query())->userWithID($followedUserID);

            $relation = (new UsersFollowUsers_Relations_Query($this->lang))->relationWithUserIDAndFollowedUserID($userID, $followedUserID);
            if ($relation) {
                throw new Exception('User with ID "'.$followedUserID.'" already followed by user with ID "'.$userID.'"', 0);
            }

            //
            // Create follow record
            //

            $relation = new UserFollowUser_Relation_Model();
            $relation->userID = $userID;
            $relation->followedUserID = $followedUserID;

            $relation = (new UserFollowUser_Relation_Mapper($this->lang))->create($relation);

            // Create activity

            $activity = new Activity_Model();
            $activity->type = Activity_Model::F_U_FOLLOW_U;
            $activity->subject = $user;
            $activity->data = $followed_user;

            $activity = (new UFollowU_Activity_Mapper($this->lang))->create($activity);

            $output = [
                'relation_id'        => $relation->id,
                'user_id'            => $user->id,
                'user_name'          => $user->name,
                'followed_user_id'   => $followed_user->id,
                'followed_user_name' => $followed_user->name,
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
