<?php

trait Question_URL_Trait
{
    function getHistoryURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->getID().'/history';
    }

    function getEditURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->getID().'/edit';
    }
}
