<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Questions_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $title = htmlspecialchars((string) $request->getParam('title'));

            $question = Question_Model::initWithTitle($title);

            try {
                $question = (new Question_Mapper($this->lang))->create($question);
            } catch (\Exception $e) {
                if ($e->getCode() == 23000) {
                    $question = (new Question_Query($this->lang))->questionWithTitle($title);
                }
            }

            # save activity if user want that

            // $activity = new Activity_Model();
            // $activity->type = Activity_Model::F_U_ASKED_Q;
            // $activity->subject = $user;
            // $activity->data = $question;
            //
            // $activity = (new UAskedQ_Activity_Mapper())->create($activity);

            $output = [
                'lang' => $this->lang,
                'id' => $question->id,
                'title' => $question->title,
                'url' => $question->get_URL($this->lang),
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
