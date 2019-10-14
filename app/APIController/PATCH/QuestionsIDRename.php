<?php

namespace APIController\PATCH;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDRename extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');
            $questionID = (int) $request->getAttribute('id');

            $query_params = $request->getQueryParams();
            $api_key = (string) $query_params['api_key'];
            $question_new_title = (string) @$query_params['new_title'];

            $this->lang = $lang;

            // Validate params

            $user = (new \Query\User())->userWithAPIKey($api_key);

            // change question title

            $question = (new \Query\Question($this->lang))->questionWithID($questionID);
            $old_title = $question->title;
            $question->title = $question_new_title;
            $question = (new \Mapper\Question($this->lang))->update($question);

            $is_save_redirect = (bool) @$query_params['save_redirect'];
            if ($is_save_redirect) {
                if (mb_strtolower($question_new_title) != mb_strtolower($old_title)) {
                    // create question record with OLD title & redirect flag
                    $old_question = new \Model\Question();
                    $old_question->title = $old_title;
                    $old_question->isRedirect = true;
                    $old_question = (new \Mapper\Question($this->lang))->create($old_question);

                    // create redirect record
                    $this->redirect = new \Model\Redirect\Question();
                    $this->redirect->fromID = $old_question->id;
                    $this->redirect->toTitle = $question->title;
                    $this->redirect = (new \Mapper\Redirect\Question($this->lang))->create($this->redirect);
                }
            }

            //
            // Create activities
            //

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::U_RENAME_Q;
            $activity->subject = $user;
            $activity->data = ['question' => $question, 'old_title' => $old_title];
            $activity = (new \Mapper\Activity\URenameQ($this->lang))->create($activity);

            $activity2 = new \Model\Activity();
            $activity2->type = \Model\Activity::Q_RENAMED_BY_U;
            $activity2->subject = $question;
            $activity2->data = ['user' => $user, 'old_title' => $old_title];
            $activity2 = (new \Mapper\Activity\QRenamedByU($this->lang))->create($activity2);

            $output = [
                'question' => [
                    'id'        => $question->id,
                    'old_title' => $old_title,
                    'new_title' => $question->title,
                    'url'       => $question->getURL($this->lang),
                ],
                'user' => [
                    'id'   => $user->id,
                    'name' => $user->name,
                ],
                'activities' => [
                    [
                        'id'   => $activity->id,
                        'type' => $activity->type,
                    ],
                    [
                        'id'   => $activity2->id,
                        'type' => $activity2->type,
                    ],
                ],
            ];

            if (isset($this->redirect)) {
                $output['redirect'] = [
                    'from_id'  => $this->redirect->fromID,
                    'to_title' => $this->redirect->toTitle,
                ];
            }
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
