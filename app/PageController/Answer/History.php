<?php

namespace PageController\Answer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class History extends \PageController\PageController
{
    protected $question;
    protected $revisions;
    protected $users;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $answer_ID = $args['id'];

        try {
            $this->question = (new \Query\Question($this->lang))->question_with_ID($answer_ID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->revisions = (new \Query\Revisions($this->lang))->revisions_for_answer_with_ID($answer_ID);

        $this->users = [];
        foreach ($this->revisions as &$revision) {
            $this->users[] = (new \Query\User())->user_with_ID($revision->userID);
        }

        $this->template = 'answer_history';
        $this->pageTitle = __('page_answer_history.page_title') . ': ' . $this->question->title . ' – ' . __('common.answeropedia');
        $this->pageDescription = __('page_answer_history.page_title');

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
