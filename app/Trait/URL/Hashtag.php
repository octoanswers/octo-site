<?php

trait Hashtag_URL_Trait
{
    public function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/tag/'.urlencode($this->title);
    }
}
