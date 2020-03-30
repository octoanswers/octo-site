<?php

namespace APIController\DELETE;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDFollow extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');
            $followed_user_ID = (int) $request->getAttribute('id');

            $query_params = $request->getQueryParams();
            $api_key = (string) $query_params['api_key'];

            //
            // Validate params
            //

            $user = (new \Query\User())->userWithAPIKey($api_key);
            $user_ID = $user->id;

            $followed_user = (new \Query\User())->userWithID($followed_user_ID);

            $relation = (new \Query\Relations\UsersFollowUsers($lang))->relationWithUserIDAndFollowedUserID($user_ID, $followed_user_ID);
            if (!$relation) {
                throw new \Exception('User with ID "'.$followed_user_ID.'" not followed by user with ID "'.$user_ID.'"', 0);
            }

            //
            // Delete follow record
            //

            (new \Mapper\Relation\UserFollowUser($lang))->delete_relation($relation);

            $output = [
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
