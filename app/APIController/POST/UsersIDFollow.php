<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDFollow extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $post_params = $request->getParsedBody();
            $api_key = (string) $post_params['api_key'];
            $followed_user_ID = (int) $args['id'];

            //
            // Validate params
            //

            $user = (new \Query\User())->user_with_API_key($api_key);

            $followed_user = (new \Query\User())->user_with_ID($followed_user_ID);

            $relation = (new \Query\Relations\UsersFollowUsers($this->lang))->relation_with_user_ID_and_followed_user_ID($user->id, $followed_user_ID);
            if ($relation) {
                throw new \Exception('User with ID "' . $followed_user_ID . '" already followed by user with ID "' . $user->id . '"', 0);
            }

            //
            // Create follow record
            //

            $relation = new \Model\Relation\UserFollowUser();
            $relation->userID = $user->id;
            $relation->followedUserID = $followed_user_ID;

            $relation = (new \Mapper\Relation\UserFollowUser($this->lang))->create($relation);

            // Create activity

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::F_U_FOLLOW_U;
            $activity->subject = $user;
            $activity->data = $followed_user;

            $activity = (new \Mapper\Activity\UFollowU($this->lang))->create($activity);

            $output = [
                'relation_id'        => $relation->id,
                'user_id'            => $user->id,
                'user_name'          => $user->name,
                'followed_user_id'   => $followed_user->id,
                'followed_user_name' => $followed_user->name,
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
