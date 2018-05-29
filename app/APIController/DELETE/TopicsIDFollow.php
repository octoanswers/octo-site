<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class TopicsIDFollow_DELETE_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $this->l = Localizer::getInstance($this->lang);

            $api_key = (string) $request->getParam('api_key');
            $topicID = (int) $args['id'];

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->getID();

            $topic = (new Topic_Query($this->lang))->topicWithID($topicID);

            $relation = (new UsersFollowTopics_Relations_Query($this->lang))->relationWithUserIDAndTopicID($userID, $topicID);
            if (!$relation) {
                throw new Exception('User with ID "'.$userID.'" not followed topic with ID "'.$topicID.'"', 0);
            }

            #
            # Delete follow record
            #

            (new UserFollowTopic_Relation_Mapper($this->lang))->deleteRelation($relation);

            $output = [
                'user_id' => $user->getID(),
                'user_name' => $user->getName(),
                'unfollowed_topic' => [
                    'id' => $topic->getID(),
                    'title' => $topic->getTitle(),
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
