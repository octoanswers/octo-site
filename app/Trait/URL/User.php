<?php

trait User_URL_Trait
{
    public function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/+'.$this->username;
    }

    public function getShortURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/user/'.$this->id;
    }

    public function getAvatarSmallURL(): string
    {
        return SITE_URL.'/uploads/avatar/'.$this->id.'_100.jpg';
    }

    public function getAvatarMediumURL(): string
    {
        return SITE_URL.'/uploads/avatar/'.$this->id.'_200.jpg';
    }

    public function getAvatarLargeURL(): string
    {
        return SITE_URL.'/uploads/avatar/'.$this->id.'_400.jpg';
    }
}
