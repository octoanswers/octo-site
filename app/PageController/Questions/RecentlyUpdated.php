<?php

namespace PageController\Questions;

class RecentlyUpdated extends \PageController\PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $this->questions = (new \Query\Questions($this->lang))->find_recently_updated($this->page - 1);

        // foreach ($this->questions as $question) {
        //     $contributors_array = (new \Query\Contributors($this->lang))->find_answer_contributors($question->id);
        //     foreach ($contributors_array as $contributor) {
        //         $this->contributors[$question->id][] = $contributor;
        //     }
        // }

        $this->template = 'questions';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->list = 'recently_updated';

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = \Helper\URL\Questions::get_recently_updated_URL($this->lang, ($this->page + 1));
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
        return __('questions.recently_updated.title') . ' &middot; ' . __('common.page') . ' ' . $this->page . ' &middot; ' . __('common.answeropedia');
    }

    public function _get_page_description(): string
    {
        $description = __('questions.recently_updated.title') . ' &middot; ' . __('common.page') . ' ' . $this->page . ' &middot; ' . __('common.answeropedia');

        return $description;
    }
}
