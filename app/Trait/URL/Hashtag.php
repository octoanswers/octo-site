<?php

trait Hashtag_URL_Trait
{
    public function getURL(string $lang): string
    {
        $this->title = mb_strtolower($this->title);

        return SITE_URL.'/'.$lang.'/tag/'.urlencode($this->title);
    }
}
