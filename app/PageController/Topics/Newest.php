<?php

class Newest_Topics_PageController extends Abstract_PageController
{
    const HASHTAGS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->l = Localizer::getInstance($this->lang);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $topicsCount = (new Topics_Query($this->lang))->topicsLastID();

        $this->topics = (new Topics_Query($this->lang))->findNewest($this->page);

        $this->template = 'topics/newest';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = "Хештеги";
        $this->activeFilter = 'newest';

        if ((isset($this->topics[9])) && ($this->topics[9]->getID() > 1)) {
            $this->nextPageURL = Topics_URL_Helper::getNewestURL($this->lang, ($this->page + 1));
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
        return _('New topics').' - '._('Page').' '.$this->page.' - '.$this->l->t('octoanswers');
    }
}
