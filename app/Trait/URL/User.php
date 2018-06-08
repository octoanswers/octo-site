<?php

trait User_URL_Trait
{
    function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/+'.$this->getUsername();
    }

    function getShortURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/user/'.$this->getID();
    }

    function getAvatarSmallURL(): string
    {
        return SITE_URL.'/uploads/avatar/'.$this->getID().'_100.jpg';
    }

    function getAvatarMediumURL(): string
    {
        return SITE_URL.'/uploads/avatar/'.$this->getID().'_200.jpg';
    }

    function getAvatarLargeURL(): string
    {
        return SITE_URL.'/uploads/avatar/'.$this->getID().'_400.jpg';
    }
}
