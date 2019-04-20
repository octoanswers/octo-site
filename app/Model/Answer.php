<?php

class Answer_Model extends Abstract_Model
{
    public $id; // int
    public $text; // string
    public $updatedAt; // string

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
}
