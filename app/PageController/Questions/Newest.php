<?php

namespace PageController\Questions;

class Newest extends \PageController\PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $this->questions = $this->_get_questions();

        $this->count_questions_with_answers = (new \Query\QuestionsCount($this->lang))->count_questions_with_answers();
        $this->count_questions_without_answers = (new \Query\QuestionsCount($this->lang))->count_questions_without_answers();

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

    protected function _get_questions(): array
    {
        $top_questions = [];

        $questions = (new \Query\Questions($this->lang))->find_newest_with_answer($this->page);

        foreach ($questions as $question) {
            $contributors = (new \Query\Contributors($this->lang))->find_answer_contributors($question->id);

            $categories = (new \Query\Categories($this->lang))->categories_for_question_with_ID($question->id);
            if (count($categories) > 2) {
                $categories = array_slice($categories, 0, 2);
            }

            $top_questions[] = [
                'question'         => $question,
                'categories'       => $categories,
                'contributors'     => $contributors
            ];
        }

        return $top_questions;
    }
}
