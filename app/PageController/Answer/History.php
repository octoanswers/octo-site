<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class History_Answer_PageController extends Abstract_PageController
{
    protected $question;
    protected $revisions;
    protected $users;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $answerID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($answerID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->revisions = (new Revisions_Query($this->lang))->revisionsForAnswerWithID($answerID);

        $this->users = [];
        foreach ($this->revisions as &$revision) {
            $this->users[] = (new User_Query())->userWithID($revision->userID);
        }

        $this->template = 'answer_history';
        $this->pageTitle = $this->translator->get('answer_history', 'page_title').' '.$this->question->title.' – '.$this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get('answer_history', 'page_title');

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
