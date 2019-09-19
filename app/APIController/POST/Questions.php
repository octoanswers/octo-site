<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Questions_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $title = htmlspecialchars((string) $request->getParam('title'));

            $question = \Model\Question::init_with_title($title);

            try {
                $question = (new \Mapper\Question($this->lang))->create($question);
            } catch (\Exception $e) {
                if ($e->getCode() == 23000) {
                    $question = (new Question_Query($this->lang))->question_with_title($title);
                }
            }

            // save activity if user want that

            // $activity = new \Model\Activity();
            // $activity->type = \Model\Activity::F_U_ASKED_Q;
            // $activity->subject = $user;
            // $activity->data = $question;
            //
            // $activity = (new \Mapper\Activity\UAskedQ())->create($activity);

            $output = [
                'lang'  => $this->lang,
                'id'    => $question->id,
                'title' => $question->title,
                'url'   => $question->get_URL($this->lang),
            ];
        } catch (Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
