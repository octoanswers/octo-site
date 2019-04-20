<?php

trait Question_URL_Trait
{
    public function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/'.$this->id.'/'.URISlug_Helper::slug($this->title);
    }

    public function getShortURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/'.$this->id;
    }

    # Image URLs

    public function getImageURLLarge(string $lang): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$this->id.'/'.$this->imageBaseName.'_lg.jpg';
    }

    public function getImageURLMedium(string $lang): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$this->id.'/'.$this->imageBaseName.'_md.jpg';
    }

    // Some actions

    public function getUpdateHashtagsURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/question/'.$this->id.'/hashtags';
    }

    public function getHistoryURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->id.'/history';
    }

    public function getEditURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->id.'/edit';
    }
}
