<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class History_Answer_PageController extends Abstract_PageController
{
    protected $question;
    protected $revisions;
    protected $users;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];
        $answerID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($answerID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->revisions = (new Revisions_Query($this->lang))->revisionsForAnswerWithID($answerID);

        $this->users = [];
        foreach ($this->revisions as &$revision) {
            $this->users[] = (new User_Query())->userWithID($revision->getUserID());
        }

        $this->template = 'answer/history';
        $this->pageTitle = _('Answer history - Page title').$this->question->getTitle().' - '._('OctoAnswers');
        $this->pageDescription = _('Answer history - Page description');

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
