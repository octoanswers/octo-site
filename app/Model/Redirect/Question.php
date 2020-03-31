<?php

namespace Model\Redirect;

class Question extends \Model\Model
{
    use \Model\Traits\Redirect\Question;

    public $fromID; // int

    public $toTitle; // string
}
