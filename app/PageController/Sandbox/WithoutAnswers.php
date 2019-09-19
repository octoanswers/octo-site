<?php

class WithoutAnswers_Sandbox_PageController extends Abstract_PageController
{
    const LIST_NEWEST = 'newest';
    const LIST_WITH_ANSWERS = 'with-answers';
    const LIST_WITHOUT_ANSWERS = 'without-answers';

    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $this->questionsCount = (new \Query\QuestionsCount($this->lang))->count_questions_without_answers();

        try {
            $this->questions = (new \Query\Sandbox($this->lang))->find_newest_without_answer($this->page);
        } catch (\Exception $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->template = 'sandbox';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->activeFilter = $this->translator->get('Without answers');

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = Sandbox_URL_Helper::get_without_answers_URL($this->lang, ($this->page + 1));
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
        return $this->translator->get('sandbox', 'questions_without_answers') . ' – ' . $this->translator->get('page') . ' ' . $this->page . ' – ' . $this->translator->get('answeropedia');
    }

    public function _get_page_description(): string
    {
        $description = $this->translator->get('sandbox', 'questions_without_answers') . ' – ' . $this->translator->get('page') . ' ' . $this->page . ' – ' . $this->translator->get('answeropedia');

        return $description;
    }
}
