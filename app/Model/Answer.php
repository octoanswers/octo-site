<?php

class Answer_Model
{
    private $id;
    private $text;
    private $updatedAt;

    #
    # Init methods
    #

    public static function initWithDBState(array $state): Answer_Model
    {
        $answer = new self();

        $answer->id = (int) $state['q_id'];
        $answer->text = $state['a_text'];
        $answer->updatedAt = $state['a_updated_at'];

        return $answer;
    }

    #
    # Get & Set
    #

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
