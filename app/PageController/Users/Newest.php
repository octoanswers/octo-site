<?php

class Newest_Users_PageController extends Abstract_PageController
{
    const LIST_NEWEST = 'newest';
    const LIST_POPULAR = 'popular';

    const USERS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->list = 'newest';
        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 0;

        $usersCount = (new Users_Query())->usersLastID();

        $this->users = (new Users_Query())->usersNewest();

        $this->template = 'users';
        $this->pageTitle = $this->_getPageTitle();
        $this->activeFilter = $this->_getActiveFilterName();

        $this->nextPageURL = $this->_nextPageURL();

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    #
    # Helper methods
    #

    public function _getActiveFilterName(): string
    {
        $filterName = $this->translator->get('Newest');

        return $filterName;
    }

    public function _getPageTitle()
    {
        return $this->translator->get('New users from around the world').' – '.$this->translator->get('page').' '.$this->page.' – '.$this->translator->get('answeropedia');
    }

    public function _nextPageURL()
    {
        $nextPageURL = null;

        if (count($this->users) == self::USERS_PER_PAGE) {
            $postfix = '?page='.($this->page + 1);
            $nextPageURL = SITE_URL.'/'.$this->lang.'/users/'.$this->list.$postfix;
        }

        return $nextPageURL;
    }
}
