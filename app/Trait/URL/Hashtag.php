<?php

trait Hashtag_URL_Trait
{
    public function getURL(string $lang): string
    {
        if ($this->id) {
            return SITE_URL.'/'.$lang.'/hashtag/'.$this->id.'/'.URISlug_Helper::slug($this->title);
        }

        return SITE_URL.'/'.$lang.'/hashtag/'.$this->title;
    }
}
