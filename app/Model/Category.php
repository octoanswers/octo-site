<?php

namespace Model;

class Category extends Model
{
    use \Traits\Model\Category\Init;
    use \Traits\Model\Category\URL;

    public $id; // int
    public $title; // string
    public $words; // string
    public $isRedirect = false; // bool
}
