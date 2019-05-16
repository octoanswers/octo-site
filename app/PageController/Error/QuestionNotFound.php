<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class QuestionNotFound_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $questionURI = $args['question_uri'];

        $this->questionTitle = $this->_titleFromURI($questionURI);

        $question = new Question_Model();
        $question->title = $this->questionTitle;

        $this->template = 'error/question_not_found';
        $this->showFooter = false;
        $this->pageTitle = _('Question not found').' '.$this->questionTitle.' - '._('Answeropedia');
        $this->pageDescription = _('Question not found');

        $this->questionURI = $questionURI;
        $this->includeJS[] = 'goal/question_not_found';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }

    private function _titleFromURI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $uri = str_replace('DOUBLEUNDERLINE', '_', $uri);

        $title = $uri.'?';

        return $title;
    }
}
