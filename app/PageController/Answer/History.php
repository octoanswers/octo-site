<?php

namespace PageController\Answer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class History extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $lang = $request->getAttribute('lang');
        $answer_ID = $request->getAttribute('id');

        $this->lang = $lang;

        try {
            $this->question = (new \Query\Question($this->lang))->questionWithID($answer_ID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->revisions = (new \Query\Revisions($this->lang))->revisionsForAnswerWithID($answer_ID);

        $this->users = [];
        foreach ($this->revisions as &$revision) {
            $this->users[] = (new \Query\User())->userWithID($revision->userID);
        }

        $this->template = 'answer_history';
        $this->pageTitle = __('page_answer_history.page_title') . ': ' . $this->question->title . ' – ' . __('common.answeropedia');
        $this->pageDescription = __('page_answer_history.page_title');

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
