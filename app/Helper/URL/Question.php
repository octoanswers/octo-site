<?php

class Question_URL_Helper extends Abstract_URL_Helper
{
    public static function getURL(string $lang, Question_Model $question): string
    {
        return SITE_URL.'/'.$lang.'/'.$question->getID().'/'.URISlug_Helper::slug($question->getTitle());
    }

    public static function getShortURL(string $lang, Question_Model $question): string
    {
        return SITE_URL.'/'.$lang.'/'.$question->getID();
    }

    # Image URLs

    public static function getImageURLLarge(string $lang, Question_Model $question): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$question->getID().'/'.$question->getImageBaseName().'_lg.jpg';
    }

    public static function getImageURLMedium(string $lang, Question_Model $question): string
    {
        return SITE_URL.'/uploads/img/'.$lang.'/'.$question->getID().'/'.$question->getImageBaseName().'_md.jpg';
    }

    # Action URLs

    public static function getUpdateTopicsURL(string $lang, Question_Model $question): string
    {
        return SITE_URL.'/'.$lang.'/question/'.$question->getID().'/topics';
    }

    public static function getCreateFromLinkURL(string $lang, string $questionTitle): string
    {
        return SITE_URL.'/'.$lang.'/question/create?q='.$questionTitle;
    }
}
