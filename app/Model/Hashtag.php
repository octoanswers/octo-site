<?php

class Hashtag_Model extends Abstract_Model
{
    use Hashtag_URL_Trait;

    public $id; // int
    public $title; // string
    public $words; // string

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Hashtag_Model
    {
        $hashtag = new self();
        $hashtag->title = $title;

        return $hashtag;
    }

    public static function initWithDBState(array $state): Hashtag_Model
    {
        $hashtag = new self();
        $hashtag->id = (int) $state['h_id'];
        $hashtag->title = (string) $state['h_title'];

        return $hashtag;
    }
}