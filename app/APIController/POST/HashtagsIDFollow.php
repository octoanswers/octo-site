<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HashtagsIDFollow_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $hashtagID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->getID();

            $hashtag = (new Hashtag_Query($this->lang))->hashtagWithID($hashtagID);


            $relation = (new UsersFollowHashtags_Relations_Query($this->lang))->relationWithUserIDAndHashtagID($userID, $hashtagID);
            if ($relation) {
                throw new Exception('User with ID "'.$userID.'" already followed hashtag with ID "'.$hashtagID.'"', 0);
            }

            #
            # Save UserFollowHashtag relation
            #

            $relation = new UserFollowHashtag_Relation_Model();
            $relation->setUserID($userID);
            $relation->setHashtagID($hashtagID);

            $relation = (new UserFollowHashtag_Relation_Mapper($this->lang))->create($relation);

            # Create activity

            $activity = new Activity_Model();
            $activity->type = Activity_Model::F_U_FOLLOW_H;
            $activity->subject = $user;
            $activity->data = $hashtag;
            $activity = (new UFollowH_Activity_Mapper($this->lang))->create($activity);
            $output = [
                'lang' => $this->lang,
                'relation_id' => $relation->getID(),
                'user_id' => $user->getID(),
                'user_name' => $user->getName(),
                'followed_hashtag_id' => $hashtag->getID(),
                'followed_hashtag_title' => $hashtag->getTitle(),
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
