<?php

class Hashtag_Model
{
    use Hashtag_URL_Trait;

    private $id;
    private $title;
    private $words;

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Hashtag_Model
    {
        $hashtag = new self();
        $hashtag->setTitle($title);

        return $hashtag;
    }

    public static function initWithDBState(array $state): Hashtag_Model
    {
        $hashtag = new self();
        $hashtag->setID($state['h_id']);
        $hashtag->setTitle($state['h_title']);

        return $hashtag;
    }

    #
    # Get & Set
    #

    public function getID()
    {
        return $this->id;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
