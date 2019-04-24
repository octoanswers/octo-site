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

            $new_hashtags_string = (string) $request->getParam('new_hashtags');

            if (strlen($new_hashtags_string) == 0) {
                throw new \Exception("Hashtags param not set", 0);
            }

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->id;

            $question = (new Question_Query($this->lang))->questionWithID($question_id);
            $questionID = $question->id;
            $old_hashtags_array = $question->getHashtags();

            # Check hashtags-questions ER & creat new, if needed

            $hashtags_titles = explode(',', $new_hashtags_string);
            $new_hashtags = [];
            foreach ($hashtags_titles as $hashtag_title) {
                $new_hashtags[] = trim($hashtag_title);
            }

            foreach ($new_hashtags as $hashtag_title) {
                $hashtag = (new Hashtag_Query($this->lang))->findWithTitle($hashtag_title);
                if ($hashtag === null) {
                    $hashtag = new Hashtag();
                    $hashtag->title = $hashtag_title;

                    $hashtag = (new Hashtag_Mapper($this->lang))->create($hashtag);
                }

                $er = (new HashtagsToQuestions_Relations_Query($this->lang))->findByHashtagIDAndQuestionID($hashtag->id, $question->id);
                if ($er === null) {
                    $er = new HashtagsToQuestions_Relation_Model();
                    $er->hashtagID = $hashtag->id;
                    $er->questionID = $question->id;
                    $er = (new HashtagToQuestion_Relation_Mapper($this->lang))->create($er);

                    # create activity
                    $activity = new Activity_Model();
                    $activity->type = Activity_Model::F_H_ADDED_Q;
                    $activity->subject = $hashtag;
                    $activity->data = $question;
                    $activity = (new HAddedQ_Activity_Mapper($this->lang))->create($activity);
                }
            }

            #
            # Update question
            #

            $question->setHashtags($new_hashtags);
            $question = (new Question_Mapper($this->lang))->updateHashtags($question);

            # Save activity

            // $activity = new Activity_Model();
            // $activity->type = Activity_Model::F_U_UPDATE_A;
            // $activity->subject = $user;
            // $activity->data = [ 'question' => $question, 'revision' => $revision];
            // $activity = (new UUpdateA_Activity_Mapper($this->lang))->create($activity);
            //
            // $activity = new Activity_Model();
            // $activity->type = Activity_Model::F_Q_UPDATE_A;
            // $activity->subject = $question;
            // $activity->data = ['user' => $user, 'revision' => $revision];
            // $activity = (new QUpdateA_Activity_Mapper($this->lang))->create($activity);

            $output = [
                'lang' => $this->lang,
                'question' => [
                    'id' => $question->id,
                    'title' => $question->title,
                    'url' => $question->getURL($this->lang),
                ],
                'user_id' => $user->id,
                'user_name' => $user->name,
                'old_hashtags' => $old_hashtags_array,
                'new_hashtags' => $new_hashtags,
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
