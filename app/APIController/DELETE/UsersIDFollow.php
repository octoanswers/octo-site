<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDFollow_DELETE_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $followedUserID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');

            //
            // Validate params
            //

            $user = (new User_Query())->user_with_API_key($api_key);
            $userID = $user->id;

            $followed_user = (new User_Query())->user_with_ID($followedUserID);

            $relation = (new UsersFollowUsers_Relations_Query($this->lang))->relation_with_user_ID_and_followed_user_ID($userID, $followedUserID);
            if (!$relation) {
                throw new Exception('User with ID "' . $followedUserID . '" not followed by user with ID "' . $userID . '"', 0);
            }

            //
            // Delete follow record
            //

            (new UserFollowUser_Relation_Mapper($this->lang))->deleteRelation($relation);

            $output = [
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
