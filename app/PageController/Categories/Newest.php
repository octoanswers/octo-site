<?php

class Newest_Categories_PageController extends Abstract_PageController
{
    const CATEGORIES_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $categoriesCount = (new Categories_Query($this->lang))->categories_last_ID();

        $this->categories = (new Categories_Query($this->lang))->find_newest($this->page);

        $this->template = 'categories';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->translator->get('categories', 'page_description');
        $this->activeFilter = 'newest';

        if ((isset($this->categories[9])) && ($this->categories[9]->id > 1)) {
            $this->nextPageURL = Categories_URL_Helper::get_newest_URL($this->lang, ($this->page + 1));
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
        return $this->translator->get('categories', 'new_categories') . ' – ' . $this->translator->get('page') . ' ' . $this->page . ' – ' . $this->translator->get('answeropedia');
    }
}
