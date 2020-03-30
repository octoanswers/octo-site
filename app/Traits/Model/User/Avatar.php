<?php

namespace Traits\Model\User;

trait Avatar
{
    public function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/'.$this->username;
    }

    public function getURLWithoutLang(): string
    {
        return SITE_URL.'/'.$this->username;
    }

    public function getAvatarURLSmall(): string
    {
        if ($this->is_avatar_uploaded) {
            return SITE_URL.'/uploads/avatar/'.$this->id.'_100.jpg';
        }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=100&name='.urlencode($this->name);
    }

    public function getAvatarURLMedium(): string
    {
        if ($this->is_avatar_uploaded) {
            return SITE_URL.'/uploads/avatar/'.$this->id.'_200.jpg';
        }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=200&name='.urlencode($this->name);
    }

    public function getAvatarURLLarge(): string
    {
        if ($this->is_avatar_uploaded) {
            return SITE_URL.'/uploads/avatar/'.$this->id.'_400.jpg';
        }

        return 'https://avatars.answeropedia.org/avatars/user.png?size=400&name='.urlencode($this->name);
    }
}
