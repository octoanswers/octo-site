<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Questions_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $this->l = Localizer::getInstance($this->lang);

            $title = htmlspecialchars((string) $request->getParam('title'));

            $question = Question_Model::initWithTitle($title);
            $question = (new Question_Mapper($this->lang))->create($question);

            # save activity if user want that

            // $activity = new Activity_Model();
            // $activity->setType(Activity_Model::F_U_ASKED_Q);
            // $activity->setSubject($user);
            // $activity->setData($question);
            //
            // $activity = (new UAskedQ_Activity_Mapper())->create($activity);

            $output = [
                'lang' => $this->lang,
                'id' => $question->getID(),
                'title' => $question->getTitle(),
                'url' => Question_URL_Helper::getURL($this->lang, $question),
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
