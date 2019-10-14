<?php

namespace PageController\Questions;

class Newest extends \PageController\PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $lang = $request->getAttribute('lang');

        $query_params = $request->getQueryParams();
        $this->page = @$query_params['page'] ? (int) $query_params['page'] : 1;

        $this->lang = $lang;

        $this->questions = $this->_get_questions();

        $this->countQuestionsWithAnswers = (new \Query\QuestionsCount($this->lang))->countQuestionsWithAnswers();
        $this->countQuestionsWithoutAnswers = (new \Query\QuestionsCount($this->lang))->countQuestionsWithoutAnswers();

        $this->template = 'questions';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->list = 'with-answers';

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = \Helper\URL\Questions::getNewestURL($this->lang, ($this->page + 1));
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
        return __('page_questions.newest_questions') . ' – ' . __('common.page') . ' ' . $this->page . ' – ' . __('common.answeropedia');
    }

    public function _get_page_description(): string
    {
        $description = __('page_questions.newest_questions') . ' – ' . __('common.page') . ' ' . $this->page . ' – ' . __('common.answeropedia');

        return $description;
    }

    protected function _get_questions(): array
    {
        $top_questions = [];

        $questions = (new \Query\Questions($this->lang))->findNewestWithAnswer($this->page);

        foreach ($questions as $question) {
            $contributors = (new \Query\Contributors($this->lang))->findAnswerContributors($question->id);

            $categories = (new \Query\Categories($this->lang))->categoriesForQuestionWithID($question->id);
            if (count($categories) > 2) {
                $categories = array_slice($categories, 0, 2);
            }

            $top_questions[] = [
                'question'         => $question,
                'categories'       => $categories,
                'contributors'     => $contributors,
            ];
        }

        return $top_questions;
    }
}
