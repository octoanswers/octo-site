<?php

namespace Model\Traits\Question;

trait URL
{
    public function getURL(string $lang): string
    {
        $uri = rtrim($this->title, '?');
        $uri = str_replace('_', '__', $uri);
        $uri = str_replace(' ', '_', $uri);

        return SITE_URL . '/' . $lang . '/' . urlencode($uri);
    }

    public function getShortURL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/question/' . $this->id;
    }

    // Some actions

    public function getUpdateCategoriesURL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/question/' . $this->id . '/categories';
    }

    public function getHistoryURL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/answer/' . $this->id . '/history';
    }

    public function getEditURL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/answer/' . $this->id . '/edit';
    }

    public function getDiscussionURL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/question/' . $this->id . '/discussion';
    }
}
