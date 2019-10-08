<?php

namespace Traits\Model\Category;

trait Avatar
{
    public function get_avatar_URL_small(): string
    {
        // if ($this->is_avatar_uploaded) {
        //     return SITE_URL . '/uploads/avatar/' . $this->id . '_100.jpg';
        // }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=100&name=' . urlencode($this->title);
    }
}
