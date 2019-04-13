<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UpdateHashtags_Question_PageController extends Abstract_PageController
{
    protected $question;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];
        $questionID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($questionID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->hashtags_string = $this->question->getHashtags() ? implode(", ", $this->question->getHashtags()) : '';

        $this->template = 'question_update_hashtags';
        $this->pageTitle = str_replace("%question%", $this->question->getTitle(), _('Update hashtags for question "%question%" - Answeropedia'));
        $this->pageDescription = str_replace("%question%", $this->question->getTitle(), _('Update hashtags for question "%question%"'));
        $this->includeJS[] = 'question/update_hashtags';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
