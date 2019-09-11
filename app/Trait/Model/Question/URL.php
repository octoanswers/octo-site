<?php

trait URL_Question_Model_Trait
{
    public function get_URL(string $lang): string
    {
        $uri = rtrim($this->title, '?');
        $uri = str_replace('_', '__', $uri);
        $uri = str_replace(' ', '_', $uri);

        return SITE_URL . '/' . $lang . '/' . urlencode($uri);
    }

    public function get_short_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/' . $this->id;
    }

    // Some actions

    public function get_update_categories_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/question/' . $this->id . '/categories';
    }

    public function get_history_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/answer/' . $this->id . '/history';
    }

    public function get_edit_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/answer/' . $this->id . '/edit';
    }
}
