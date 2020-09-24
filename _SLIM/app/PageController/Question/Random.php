<?php

namespace PageController\Question;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Random extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $lang = $request->getAttribute('lang');

        $this->lang = $lang;

        try {
            $question = (new \Query\Question($this->lang))->randomQuestion();
        } catch (\Throwable $e) {
            return (new \PageController\Error\InternalServerError())->handle($request, $response);
        }

        return $response->withRedirect($question->getURL($this->lang), 303);
    }
}
