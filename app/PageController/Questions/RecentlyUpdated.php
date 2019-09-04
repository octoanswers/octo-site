<?php

class RecentlyUpdated_Questions_PageController extends Abstract_PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $this->questions = (new Questions_Query($this->lang))->find_recently_updated($this->page - 1);

        // foreach ($this->questions as $question) {
        //     $contributors_array = (new Contributors_Query($this->lang))->find_answer_contributors($question->id);
        //     foreach ($contributors_array as $contributor) {
        //         $this->contributors[$question->id][] = $contributor;
        //     }
        // }

        $this->template = 'questions';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->list = 'recently_updated';

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = Questions_URL_Helper::get_recently_updated_URL($this->lang, ($this->page + 1));
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
        return $this->translator->get('Recently updated') . ' &middot; ' . $this->translator->get('page') . ' ' . $this->page . ' &middot; ' . $this->translator->get('answeropedia');
    }

    public function _get_page_description(): string
    {
        $description = $this->translator->get('Recently updated') . ' &middot; ' . $this->translator->get('page') . ' ' . $this->page . ' &middot; ' . $this->translator->get('answeropedia');

        return $description;
    }
}
