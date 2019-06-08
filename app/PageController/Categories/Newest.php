<?php

class Newest_Categories_PageController extends Abstract_PageController
{
    const CATEGORIES_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $categoriesCount = (new Categories_Query($this->lang))->categoriesLastID();

        $this->categories = (new Categories_Query($this->lang))->findNewest($this->page);

        $this->template = 'categories';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = $this->translator->get('categories_newest', 'page_description');
        $this->activeFilter = 'newest';

        if ((isset($this->categories[9])) && ($this->categories[9]->id > 1)) {
            $this->nextPageURL = Categories_URL_Helper::getNewestURL($this->lang, ($this->page + 1));
        }

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    #
    # Helper methods
    #

    public function _getPageTitle()
    {
        return $this->translator->get('New categories').' · '.$this->translator->get('page').' '.$this->page.' · '.$this->translator->get('answeropedia');
    }
}
