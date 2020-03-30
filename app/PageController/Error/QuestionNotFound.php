<?php

namespace PageController\Error;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionNotFound extends \PageController\PageController
{
    public function handle(Request $request, Response $response): Response
    {
        $lang = $request->getAttribute('lang');
        $question_URI = $request->getAttribute('question_uri');

        $this->lang = $lang;

        $this->questionTitle = \Helper\Title::titleFromQuestionURI($question_URI);

        $question = new \Model\Question();
        $question->title = $this->questionTitle;

        $this->template = 'error/question_not_found';
        $this->showFooter = false;
        $this->pageTitle = __('page_error.question_not_found.page_title').' – '.$this->questionTitle.' – '.__('common.answeropedia');
        $this->pageDescription = __('page_error.question_not_found.page_title');

        $this->questionURI = $question_URI;
        $this->includeJS[] = 'goal/question_not_found';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }
}
