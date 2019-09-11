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

    // Image URLs

    public function get_image_URL_large(string $lang): string
    {
        return SITE_URL . '/uploads/img/' . $lang . '/' . $this->id . '/' . $this->imageBaseName . '_lg.jpg';
    }

    public function get_image_URL_medium(string $lang): string
    {
        return SITE_URL . '/uploads/img/' . $lang . '/' . $this->id . '/' . $this->imageBaseName . '_md.jpg';
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
