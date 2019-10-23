<?php

namespace PageController\Questions;

class RecentlyUpdated extends \PageController\PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $lang = $request->getAttribute('lang');

        $query_params = $request->getQueryParams();
        $this->page = @$query_params['page'] ? (int) $query_params['page'] : 1;

        $this->lang = $lang;

        $this->questions = (new \Query\Questions($this->lang))->findRecentlyUpdated($this->page - 1);

        // foreach ($this->questions as $question) {
        //     $contributors_array = (new \Query\Answer($this->lang))->findContributors($question->id);
        //     foreach ($contributors_array as $contributor) {
        //         $this->contributors[$question->id][] = $contributor;
        //     }
        // }

        $this->template = 'questions';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->list = 'recently_updated';

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = \Helper\URL\Questions::getRecentlyUpdatedURL($this->lang, ($this->page + 1));
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
