<?php

namespace Model;

class Answer extends Model
{
    use \Init_Answer_Model_Trait;

    public $id; // int
    public $text; // string
    public $updatedAt; // string
}
