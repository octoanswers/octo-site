<?php

namespace Model\Redirect;

class Category extends \Model\Model
{
    use \Traits\Model\Redirect\Category;

    public $from_ID; // int
    public $to_title; // string
}
