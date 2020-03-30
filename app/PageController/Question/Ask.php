<?php

namespace PageController\Question;

class Ask extends \PageController\Basic
{
    public function get_data(): \DTO\ViewData\Question\Ask
    {
        $view_data = new \DTO\ViewData\Question\Ask();

        $view_data->lang = $this->lang;
        $view_data->auth_user = $this->auth_user;

        $view_data->page_title = $this->_get_page_title();

        $view_data->include_JS[] = 'question/create';

        return $view_data;
    }

    // Helper methods

    protected function _get_page_title()
    {
        return __('page_ask.page_title').' – '.__('common.answeropedia');
    }
}
