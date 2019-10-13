<?php

namespace Controller\Users;

class Newest extends \Controller\Basic
{
    const USERS_PER_PAGE = 10;

    public function get_data(string $list, int $page = 0): \DTO\ViewData\Users\Newest
    {
        $view_data = new \DTO\ViewData\Users\Newest();

        $view_data->lang = $this->lang;
        $view_data->list = $list;
        $view_data->page = $page;

        $view_data->users_count = (new \Query\Users())->users_last_ID();
        $view_data->users = (new \Query\Users())->users_newest();

        $view_data->page_title = $this->_get_page_title($page);
        $view_data->next_page_URL = $this->_next_page_URL($this->lang, $list, $page, count($view_data->users));

        return $view_data;
    }

    // Helper methods

    protected function _get_page_title(int $page)
    {
        return __('page_users.new_users_msg') . ' – ' . __('common.page') . ' ' . $page . ' – ' . __('common.answeropedia');
    }

    protected function _next_page_URL($lang, $list, $current_page, int $users_count)
    {
        $nextPageURL = null;

        if ($users_count == self::USERS_PER_PAGE) {
            $postfix = '?page=' . ($current_page + 1);
            $nextPageURL = SITE_URL . '/' . $lang . '/users/' . $list . $postfix;
        }

        return $nextPageURL;
    }
}
