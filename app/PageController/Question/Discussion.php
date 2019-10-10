<?php

namespace PageController\Question;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Discussion extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $question_ID = $args['id'];

        try {
            $this->question = (new \Query\Question($this->lang))->question_with_ID($question_ID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->template = 'question_discussion';
        $this->pageTitle = __('page_question_discussion.page_prefix') . ' ' . $this->question->title . __('common.answeropedia');
        $this->pageDescription = $this->pageTitle;
        $this->showFooter = false;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
