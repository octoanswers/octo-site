<?php

trait Question_URL_Trait
{
    function getURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/'.$this->getID().'/'.URISlug_Helper::slug($this->getTitle());
    }

    function getShortURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/'.$this->getID();
    }

    # Image URLs

    function getImageURLLarge(string $lang): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$this->getID().'/'.$this->getImageBaseName().'_lg.jpg';
    }

    function getImageURLMedium(string $lang): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$this->getID().'/'.$this->getImageBaseName().'_md.jpg';
    }

    // Some actions

    function getUpdateHashtagsURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/question/'.$this->getID().'/hashtags';
    }

    function getHistoryURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->getID().'/history';
    }

    function getEditURL(string $lang): string
    {
        return SITE_URL.'/'.$lang.'/answer/'.$this->getID().'/edit';
    }
}
