<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Questions extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $post_params = $request->getParsedBody();
            $title = htmlspecialchars((string) $post_params['title']);

            $question = \Model\Question::init_with_title($title);

            try {
                $question = (new \Mapper\Question($this->lang))->create($question);
            } catch (\Exception $e) {
                if ($e->getCode() == 23000) {
                    $question = (new \Query\Question($this->lang))->question_with_title($title);
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
