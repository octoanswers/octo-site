<?php

trait Avatar_User_Model_Trait
{
    public function get_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/@' . $this->username;
    }

    public function get_short_URL(string $lang): string
    {
        return SITE_URL . '/' . $lang . '/user/' . $this->id;
    }

    public function get_avatar_URL_small(): string
    {
        if ($this->is_avatar_uploaded) {
            return SITE_URL . '/uploads/avatar/' . $this->id . '_100.jpg';
        }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=100&name=' . urlencode($this->name);
    }

    public function get_avatar_URL_medium(): string
    {
        if ($this->is_avatar_uploaded) {
            return SITE_URL . '/uploads/avatar/' . $this->id . '_200.jpg';
        }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=200&name=' . urlencode($this->name);
    }

    public function get_avatar_URL_large(): string
    {
        if ($this->is_avatar_uploaded) {
            return SITE_URL . '/uploads/avatar/' . $this->id . '_400.jpg';
        }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=400&name=' . urlencode($this->name);
    }
}
