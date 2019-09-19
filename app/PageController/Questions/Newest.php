<?php

class Newest_Questions_PageController extends Abstract_PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $questionsCount = (new \Query\QuestionsCount($this->lang))->questions_last_ID();

        $this->questions = (new \Query\Questions($this->lang))->find_newest_with_answer($this->page);

        $this->questionsCount = (new \Query\QuestionsCount($this->lang))->count_questions_with_answers();

        foreach ($this->questions as $question) {
            $contributors_array = (new \Query\Contributors($this->lang))->find_answer_contributors($question->id);
            foreach ($contributors_array as $contributor) {
                $this->contributors[$question->id][] = $contributor;
            }
        }

        $this->template = 'questions';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->list = 'with-answers';

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = \Helper\URL\Questions::get_newest_URL($this->lang, ($this->page + 1));
        }

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    //
    // Helper methods
    //

    public function _get_page_title()
    {
        return $this->translator->get('questions', 'newest_questions') . ' – ' . $this->translator->get('page') . ' ' . $this->page . ' – ' . $this->translator->get('answeropedia');
    }

    public function _get_page_description(): string
    {
        $description = $this->translator->get('questions', 'newest_questions') . ' – ' . $this->translator->get('page') . ' ' . $this->page . ' – ' . $this->translator->get('answeropedia');

        return $description;
    }
}
