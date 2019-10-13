<?php

namespace PageController\Sandbox;

class WithoutAnswers extends \PageController\PageController
{
    const LIST_NEWEST = 'newest';
    const LIST_WITH_ANSWERS = 'with-answers';
    const LIST_WITHOUT_ANSWERS = 'without-answers';

    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $query_params = $request->getQueryParams();

        $this->lang = $args['lang'];
        $this->page = @$query_params['page'] ? (int) $query_params['page'] : 1;

        $this->questionsCount = (new \Query\QuestionsCount($this->lang))->count_questions_without_answers();

        try {
            $this->questions = (new \Query\Sandbox($this->lang))->find_newest_without_answer($this->page);
        } catch (\Exception $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->template = 'sandbox';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = \Helper\URL\Sandbox::get_without_answers_URL($this->lang, ($this->page + 1));
        }

        $this->list = 'without-answers';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    //
    // Helper methods
    //

    public function _get_page_title()
    {
        return __('page_sandbox.questions_without_answers') . ' – ' . __('common.page') . ' ' . $this->page . ' – ' . __('common.answeropedia');
    }

    public function _get_page_description(): string
    {
        $description = __('page_sandbox.questions_without_answers') . ' – ' . __('common.page') . ' ' . $this->page . ' – ' . __('common.answeropedia');

        return $description;
    }
}
