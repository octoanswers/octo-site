<?php

namespace Model\Redirect;

class Category extends \Model\Model
{
    use \Category_Redirect_Model_Trait;

    public $from_ID; // int
    public $to_title; // string
}
