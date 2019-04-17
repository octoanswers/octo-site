<?php

trait Question_URL_Trait
{
    public function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/'.$this->getID().'/'.URISlug_Helper::slug($this->title);
    }

    public function getShortURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/'.$this->getID();
    }

    # Image URLs

    public function getImageURLLarge(string $lang): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$this->getID().'/'.$this->imageBaseName.'_lg.jpg';
    }

    public function getImageURLMedium(string $lang): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$this->getID().'/'.$this->imageBaseName.'_md.jpg';
    }

    // Some actions

    public function getUpdateHashtagsURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/question/'.$this->getID().'/hashtags';
    }

    public function getHistoryURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->getID().'/history';
    }

    public function getEditURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->getID().'/edit';
    }
}
