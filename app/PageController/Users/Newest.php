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

        $usersCount = (new Users_Query())->users_last_ID();

        $this->users = (new Users_Query())->users_newest();

        $this->template = 'users';
        $this->pageTitle = $this->_get_page_title();
        $this->activeFilter = $this->_get_active_filter_name();

        $this->nextPageURL = $this->_next_page_URL();

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    //
    // Helper methods
    //

    public function _get_active_filter_name(): string
    {
        $filterName = $this->translator->get('Newest');

        return $filterName;
    }

    public function _get_page_title()
    {
        return $this->translator->get('users', 'new_users_msg') . ' – ' . $this->translator->get('page') . ' ' . $this->page . ' – ' . $this->translator->get('answeropedia');
    }

    public function _next_page_URL()
    {
        $nextPageURL = null;

        if (count($this->users) == self::USERS_PER_PAGE) {
            $postfix = '?page=' . ($this->page + 1);
            $nextPageURL = SITE_URL . '/' . $this->lang . '/users/' . $this->list . $postfix;
        }

        return $nextPageURL;
    }
}
