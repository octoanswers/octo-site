<?php

namespace PageController\Question;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Random extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];

        $questions_count = (new \Query\QuestionsCount($this->lang))->questionsLastID();

        $random_question_ID = mt_rand(1, $questions_count);

        try {
            $question = (new \Query\Question($this->lang))->questionWithID($random_question_ID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($question->getURL($this->lang), 303);
    }
}
