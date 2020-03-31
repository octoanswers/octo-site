<?php

namespace Model\Traits\Category;

trait Avatar
{
    public function getAvatarURLSmall(): string
    {
        // if ($this->is_avatar_uploaded) {
        //     return SITE_URL . '/uploads/avatar/' . $this->id . '_100.jpg';
        // }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=100&name=' . urlencode($this->title);
    }
}
