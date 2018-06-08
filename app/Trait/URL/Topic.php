<?php

trait Topic_URL_Trait
{
    function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/topic/'.$this->getID().'/'.URISlug_Helper::slug($this->getTitle());
    }
}
