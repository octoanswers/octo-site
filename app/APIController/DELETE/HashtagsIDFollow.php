<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HashtagsIDFollow_DELETE_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            
            $api_key = (string) $request->getParam('api_key');
            $hashtagID = (int) $args['id'];

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);

            $hashtag = (new Hashtag_Query($this->lang))->hashtagWithID($hashtagID);

            $relation = (new UsersFollowHashtags_Relations_Query($this->lang))->relationWithUserIDAndHashtagID($user->id, $hashtagID);
            if (!$relation) {
                throw new Exception('User with ID "'.$user->id.'" not followed hashtag with ID "'.$hashtagID.'"', 0);
            }

            #
            # Delete follow record
            #

            (new UserFollowHashtag_Relation_Mapper($this->lang))->deleteRelation($relation);

            $output = [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'unfollowed_hashtag' => [
                    'id' => $hashtag->id,
                    'title' => $hashtag->title,
                ],
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
