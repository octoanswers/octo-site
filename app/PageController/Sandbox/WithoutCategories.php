<?php

namespace PageController\Sandbox;

class WithoutCategories extends \PageController\PageController
{
    const LIST_NEWEST = 'newest';
    const LIST_WITH_ANSWERS = 'with-answers';
    const LIST_WITHOUT_ANSWERS = 'without-answers';

    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        try {
            $this->questions = (new \Query\Sandbox($this->lang))->questions_without_categories($this->page);
        } catch (\Exception $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->template = 'sandbox';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->activeFilter = $this->translator->get('Without answers');

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = \Helper\URL\Sandbox::get_without_answers_URL($this->lang, ($this->page + 1));
        }

        $this->list = 'without_categories';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    //
    // Helper methods
    //

    public function _get_page_title()
    {
        return __('page_sandbox.without_categories') . ' – ' . __('common.page') . ' ' . $this->page . ' – ' . __('common.answeropedia');
    }

    public function _get_page_description(): string
    {
        $description = __('page_sandbox.without_categories') . ' – ' . __('common.page') . ' ' . $this->page . ' – ' . __('common.answeropedia');

        return $description;
    }
}
