<?php

namespace PageController\Question;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Random extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $questions_count = (new \Query\QuestionsCount($this->lang))->questions_last_ID();

        $random_question_ID = mt_rand(1, $questions_count);

        try {
            $question = (new \Query\Question($this->lang))->question_with_ID($random_question_ID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($question->get_URL($this->lang), 303);
    }
}
