<?php

class User_URL_Helper extends Abstract_URL_Helper
{
    public static function getURL(string $lang, User_Model $user): string
    {
        return SITE_URL.'/'.$lang.'/+'.$user->getUsername();
    }

    public static function getShortURL(string $lang, User_Model $user): string
    {
        return SITE_URL.'/'.$lang.'/user/'.$user->getID();
    }

    public static function getAvatarSmallURL(User_Model $user): string
    {
        return SITE_URL.'/uploads/avatar/'.$user->getID().'_100.jpg';
    }

    public static function getAvatarMediumURL(User_Model $user): string
    {
        return SITE_URL.'/uploads/avatar/'.$user->getID().'_200.jpg';
    }

    public static function getAvatarLargeURL(User_Model $user): string
    {
        return SITE_URL.'/uploads/avatar/'.$user->getID().'_400.jpg';
    }
}
