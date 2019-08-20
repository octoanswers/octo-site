<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Random_Question_PageController extends Abstract_PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $questionsCount = (new QuestionsCount_Query($this->lang))->questionsLastID();

        $randomQuestionID = mt_rand(1, $questionsCount);

        try {
            $question = (new Question_Query($this->lang))->questionWithID($randomQuestionID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($question->get_URL($this->lang), 303);
    }
}
