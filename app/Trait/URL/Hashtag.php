<?php

trait Hashtag_URL_Trait
{
    public function getURL(string $lang): string
    {
        if ($this->getID()) {
            return SITE_URL.'/'.$lang.'/hashtag/'.$this->getID().'/'.URISlug_Helper::slug($this->title);
        }

        return SITE_URL.'/'.$lang.'/hashtag/'.$this->title;
    }
}
