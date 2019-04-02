<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Edit_Answer_PageController extends Abstract_PageController
{
    protected $question;
    protected $answer;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];
        $answerID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($answerID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->answer = (new Answers_Query($this->lang))->answerWithID($this->question->getID());

        if ($this->answer == null) {
            $answer = new Answer_Model();
            $answer->setID($this->question->getID());
            $answer->setText(null);

            $this->answer = (new Answer_Mapper())->create($answer);
        }

        $this->template = 'answer/edit';
        $this->showFooter = false;
        $this->pageTitle = $this->question->getTitle().' &middot; '._('Edit answer').' &middot; '._('Answeropedia');
        $this->pageDescription = _('Edit answer');
        $this->includeJS[] = 'answer/update.js?v=1';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
