<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Random_Question_PageController extends Abstract_PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];
        
        $questionsCount = (new QuestionsCount_Query($this->lang))->questionsLastID();

        $randomQuestionID = mt_rand(1, $questionsCount);

        try {
            $question = (new Question_Query($this->lang))->questionWithID($randomQuestionID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($question->getURL($this->lang), 303);
    }
}
