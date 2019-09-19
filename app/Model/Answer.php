<?php

namespace Model;

class Answer extends Model
{
    use \Traits\Model\Answer\Init;

    public $id; // int
    public $text; // string
    public $updatedAt; // string
}
