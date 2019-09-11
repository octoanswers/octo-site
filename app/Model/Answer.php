<?php

class Answer_Model extends Abstract_Model
{
    use Init_Answer_Model_Trait;

    public $id; // int
    public $text; // string
    public $updatedAt; // string
}
