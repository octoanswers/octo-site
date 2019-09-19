<?php

namespace Model\Redirect;

class Question extends \Model\Model
{
    use \Traits\Model\Redirect\Question;

    public $fromID; // int
    public $toTitle; // string
}
