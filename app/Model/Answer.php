<?php

namespace Model;

class Answer extends Model
{
    use \Model\Traits\Answer\Init;

    public $id; // int

    public $text; // string

    public $updatedAt; // string
}
