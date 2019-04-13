<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HashtagsIDFollow_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $topicID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->getID();

            $topic = (new Topic_Query($this->lang))->topicWithID($topicID);


            $relation = (new UsersFollowTopics_Relations_Query($this->lang))->relationWithUserIDAndTopicID($userID, $topicID);
            if ($relation) {
                throw new Exception('User with ID "'.$userID.'" already followed topic with ID "'.$topicID.'"', 0);
            }

            #
            # Save UserFollowTopic relation
            #

            $relation = new UserFollowTopic_Relation_Model();
            $relation->setUserID($userID);
            $relation->setTopicID($topicID);

            $relation = (new UserFollowTopic_Relation_Mapper($this->lang))->create($relation);

            # Create activity

            $activity = new Activity_Model();
            $activity->setType(Activity_Model::F_U_FOLLOW_H);
            $activity->setSubject($user);
            $activity->setData($topic);
            $activity = (new UFollowH_Activity_Mapper($this->lang))->create($activity);
            $output = [
                'lang' => $this->lang,
                'relation_id' => $relation->getID(),
                'user_id' => $user->getID(),
                'user_name' => $user->getName(),
                'followed_topic_id' => $topic->getID(),
                'followed_topic_title' => $topic->getTitle(),
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
