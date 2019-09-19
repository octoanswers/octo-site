<?php

namespace Model\Redirect;

class Question extends \Model\Model
{
    use \Question_Redirect_Model_Trait;

    public $fromID; // int
    public $toTitle; // string
}
