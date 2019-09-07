<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionNotFound_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        // Don`t execute parent::handleRequest. Method have specific args.
        $this->lang = $lang;
        $this->translator = new Translator($this->lang, ROOT_PATH . '/app/Lang');

        $question_URI = $args['question_uri'];

        $this->questionTitle = $this->_titleFromURI($question_URI);

        $question = new Question_Model();
        $question->title = $this->questionTitle;

        $this->template = 'error/question_not_found';
        $this->showFooter = false;
        $this->pageTitle = $this->translator->get('error_page', 'question_not_found', 'page_title') . ' – ' . $this->questionTitle . ' – ' . $this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get('error_page', 'question_not_found', 'page_title');

        $this->questionURI = $question_URI;
        $this->includeJS[] = 'goal/question_not_found';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }

    private function _titleFromURI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $uri = str_replace('DOUBLEUNDERLINE', '_', $uri);

        $title = $uri . '?';

        return $title;
    }
}
