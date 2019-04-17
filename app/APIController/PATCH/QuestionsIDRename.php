<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class QuestionsIDRename_PATCH_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $questionID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');
            $questionNewTitle = (string) $request->getParam('new_title');

            # Validate params

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->getID();

            # change question title

            $question = (new Question_Query($this->lang))->questionWithID($questionID);
            $old_title = $question->getTitle();
            $question->setTitle($questionNewTitle);
            $question = (new Question_Mapper($this->lang))->update($question);

            $saveRedirect = (bool) $request->getParam('save_redirect');
            if ($saveRedirect) {
                if (mb_strtolower($questionNewTitle) != mb_strtolower($old_title)) {
                    # create question record with OLD title & redirect flag
                    $oldQuestion = new Question_Model;
                    $oldQuestion->setTitle($old_title);
                    $oldQuestion->setRedirect(true);
                    $oldQuestion = (new Question_Mapper($this->lang))->create($oldQuestion);

                    # create redirect record
                    $this->redirect = new Redirect_Model();
                    $this->redirect->fromID = $oldQuestion->getID();
                    $this->redirect->toTitle = $question->getTitle();
                    $this->redirect = (new Redirect_Mapper($this->lang))->create($this->redirect);
                }
            }

            #
            # Create activities
            #

            $activity = new Activity_Model();
            $activity->setType(Activity_Model::U_RENAME_Q);
            $activity->setSubject($user);
            $activity->setData(['question' => $question, 'old_title' => $old_title]);
            $activity = (new URenameQ_Activity_Mapper($this->lang))->create($activity);

            $activity2 = new Activity_Model();
            $activity2->setType(Activity_Model::Q_RENAMED_BY_U);
            $activity2->setSubject($question);
            $activity2->setData(['user' => $user, 'old_title' => $old_title]);
            $activity2 = (new QRenamedByU_Activity_Mapper($this->lang))->create($activity2);

            $output = [
                'question' => [
                    'id' => $question->getID(),
                    'old_title' => $old_title,
                    'new_title' => $question->getTitle(),
                    'url' => $question->getURL($this->lang),
                ],
                'user' => [
                    'id' => $user->getID(),
                    'name' => $user->getName(),
                ],
                'activities' => [
                    [
                        'id' => $activity->getID(),
                        'type' => $activity->getType(),
                    ],
                    [
                        'id' => $activity2->getID(),
                        'type' => $activity2->getType(),
                    ],
                ]
            ];

            if (isset($this->redirect)) {
                $output['redirect'] = [
                    'from_id' => $this->redirect->fromID,
                    'to_title' => $this->redirect->toTitle,
                ];
            }
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
