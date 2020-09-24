<?php

namespace Model\Redirect;

class Category extends \Model\Model
{
    use \Model\Traits\Redirect\Category;

    public $from_ID; // int

    public $to_title; // string
}
