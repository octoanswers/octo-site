<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Edit_Answer_PageController extends Abstract_PageController
{
    protected $question;
    protected $answer;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $answer_ID = $args['id'];

        try {
            $this->question = (new \Query\Question($this->lang))->question_with_ID($answer_ID);
        } catch (\Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->answer = (new \Query\Answers($this->lang))->answer_with_ID($this->question->id);

        if ($this->answer == null) {
            $answer = new \Model\Answer();
            $answer->id = $this->question->id;
            $answer->text = null;

            $this->answer = (new \Mapper\Answer($this->lang))->create($answer);
        }

        $this->question_how_to_edit = $this->_get_how_to_edit_question();

        $this->template = 'answer_edit';
        $this->showFooter = false;
        $this->pageTitle = $this->question->title . ' – ' . $this->translator->get('answer_edit', 'page_title') . ' – ' . $this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get('answer_edit', 'page_title');

        $this->includeJS[] = 'answer/update.js?v=1';
        $this->includeCSS[] = 'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    private function _get_how_to_edit_question()
    {
        try {
            $how_to_edit_question_ID = $this->translator->get('service_id', 'how_to_edit');
            $how_to_edit_question = (new \Query\Question($this->lang))->question_with_ID($how_to_edit_question_ID);
        } catch (\Throwable $e) {
            $how_to_edit_question = null;
        }

        return $how_to_edit_question;
    }
}
