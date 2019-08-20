<?php

trait User_URL_Trait
{
    public function get_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/+' . $this->username;
    }

    public function get_short_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/user/' . $this->id;
    }

    public function get_avatar_URL_small(): string
    {
        return SITE_URL . '/uploads/avatar/' . $this->id . '_100.jpg';
    }

    public function get_avatar_URL_medium(): string
    {
        return SITE_URL . '/uploads/avatar/' . $this->id . '_200.jpg';
    }

    public function get_avatar_URL_large(): string
    {
        return SITE_URL . '/uploads/avatar/' . $this->id . '_400.jpg';
    }
}
