<?php

class Hashtag_Model
{
    use Topic_URL_Trait;

    private $id;
    private $title;
    private $words;

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Hashtag_Model
    {
        $topic = new self();
        $topic->setTitle($title);

        return $topic;
    }

    public static function initWithDBState(array $state): Hashtag_Model
    {
        $topic = new self();
        $topic->setID($state['h_id']);
        $topic->setTitle($state['h_title']);

        return $topic;
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
