<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Hashtags_ID_Questions_PUT_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            
            $api_key = (string) $request->getParam('api_key');
            $question_id = (int) $args['id'];

            $new_topics_string = (string) $request->getParam('new_topics');

            if (strlen($new_topics_string) == 0) {
                throw new \Exception("Topics param not set", 0);
            }

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->getID();

            $question = (new Question_Query($this->lang))->questionWithID($question_id);
            $questionID = $question->getID();
            $old_topics_array = $question->getTopics();

            # Check topics-questions ER & creat new, if needed

            $topics_titles = explode(',', $new_topics_string);
            $new_topics = [];
            foreach ($topics_titles as $topic_title) {
                $new_topics[] = trim($topic_title);
            }

            foreach ($new_topics as $topic_title) {
                $topic = (new Topic_Query($this->lang))->findWithTitle($topic_title);
                if ($topic === null) {
                    $topic = new Topic_Model();
                    $topic->setTitle($topic_title);

                    $topic = (new Topic_Mapper($this->lang))->create($topic);
                }

                $er = (new TopicsToQuestions_Relations_Query($this->lang))->findByTopicIDAndQuestionID($topic->getID(), $question->getID());
                if ($er === null) {
                    $er = new TopicsToQuestions_Relation_Model();
                    $er->setTopicID($topic->getID());
                    $er->setQuestionID($question->getID());
                    $er = (new TopicToQuestion_Relation_Mapper($this->lang))->create($er);

                    # create activity
                    $activity = new Activity_Model();
                    $activity->setType(Activity_Model::F_H_ADDED_Q);
                    $activity->setSubject($topic);
                    $activity->setData($question);
                    $activity = (new HAddedQ_Activity_Mapper($this->lang))->create($activity);
                }
            }

            #
            # Update question
            #

            $question->setTopics($new_topics);
            $question = (new Question_Mapper($this->lang))->updateTopics($question);

            # Save activity

            // $activity = new Activity_Model();
            // $activity->setType(Activity_Model::F_U_UPDATE_A);
            // $activity->setSubject($user);
            // $activity->setData([ 'question' => $question, 'revision' => $revision]);
            // $activity = (new UUpdateA_Activity_Mapper($this->lang))->create($activity);
            //
            // $activity = new Activity_Model();
            // $activity->setType(Activity_Model::F_Q_UPDATE_A);
            // $activity->setSubject($question);
            // $activity->setData(['user' => $user, 'revision' => $revision]);
            // $activity = (new QUpdateA_Activity_Mapper($this->lang))->create($activity);

            $output = [
                'lang' => $this->lang,
                'question' => [
                    'id' => $question->getID(),
                    'title' => $question->getTitle(),
                    'url' => $question->getURL($this->lang),
                ],
                'user_id' => $user->getID(),
                'user_name' => $user->getName(),
                'old_topics' => $old_topics_array,
                'new_topics' => $new_topics,
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
