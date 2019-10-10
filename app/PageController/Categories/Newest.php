<?php

namespace PageController\Categories;

class Newest extends \PageController\PageController
{
    const CATEGORIES_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $categories_count = (new \Query\Categories($this->lang))->categories_last_ID();

        $this->categories = (new \Query\Categories($this->lang))->find_newest($this->page);

        $this->template = 'categories';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = __('page_categories.page_description');
        $this->activeFilter = 'newest';

        if ((isset($this->categories[9])) && ($this->categories[9]->id > 1)) {
            $this->nextPageURL = \Helper\URL\Categories::get_newest_URL($this->lang, ($this->page + 1));
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
        return __('page_categories.new_categories') . ' – ' . __('common.page') . ' ' . $this->page . ' – ' . __('common.answeropedia');
    }
}
