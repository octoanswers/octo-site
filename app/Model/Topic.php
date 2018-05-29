<?php

class Topic_Model
{
    private $id;
    private $title;
    private $words;

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Topic_Model
    {
        $topic = new self();
        $topic->setTitle($title);

        return $topic;
    }

    public static function initWithDBState(array $state): Topic_Model
    {
        $topic = new self();
        $topic->setID($state['t_id']);
        $topic->setTitle($state['t_title']);

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
