<?php

class Newest_Hashtags_PageController extends Abstract_PageController
{
    const HASHTAGS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $hashtagsCount = (new Hashtags_Query($this->lang))->hashtagsLastID();

        $this->hashtags = (new Hashtags_Query($this->lang))->findNewest($this->page);

        $this->template = 'hashtags';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = "Хештеги";
        $this->activeFilter = 'newest';

        if ((isset($this->hashtags[9])) && ($this->hashtags[9]->id > 1)) {
            $this->nextPageURL = Hashtags_URL_Helper::getNewestURL($this->lang, ($this->page + 1));
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
        return $this->translator->get('New hashtags').' · '.$this->translator->get('page').' '.$this->page.' · '.$this->translator->get('answeropedia');
    }
}
