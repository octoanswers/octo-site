<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Edit_Answer_PageController extends Abstract_PageController
{
    protected $question;
    protected $answer;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $answerID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($answerID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->answer = (new Answers_Query($this->lang))->answerWithID($this->question->id);

        if ($this->answer == null) {
            $answer = new Answer_Model();
            $answer->id = $this->question->id;
            $answer->text = null;

            $this->answer = (new Answer_Mapper())->create($answer);
        }

        $this->howToEditQuestion = $this->_getHowToEditQuestion();

        $this->template = 'answer_edit';
        $this->showFooter = false;
        $this->pageTitle = $this->question->title.' · '.$this->translator->get("Edit answer").' · '.$this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get("Edit answer");

        $this->includeJS[] = 'answer/update.js?v=1';
        $this->includeCSS[] = 'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    private function _getHowToEditQuestion()
    {
        try {
            $howToEditQuestionID = $this->translator->get('service_id', 'how_to_edit');
            $howToEditQuestion = (new Question_Query($this->lang))->questionWithID($howToEditQuestionID);
        } catch (Throwable $e) {
            $howToEditQuestion = null;
        }

        return $howToEditQuestion;
    }
}
