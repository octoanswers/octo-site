<?php

namespace PageController\Categories;

class Newest extends \PageController\PageController
{
    const CATEGORIES_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $lang = $request->getAttribute('lang');

        $query_params = $request->getQueryParams();
        $this->page = @$query_params['page'] ? (int) $query_params['page'] : 1;

        $this->lang = $lang;

        $categories_count = (new \Query\Categories($this->lang))->categoriesLastID();

        $this->categories = (new \Query\Categories($this->lang))->findNewest($this->page);

        $this->template = 'categories';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = __('page_categories.page_description');
        $this->activeFilter = 'newest';

        if ((isset($this->categories[9])) && ($this->categories[9]->id > 1)) {
            $this->nextPageURL = \Helper\URL\Categories::getNewestURL($this->lang, ($this->page + 1));
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
