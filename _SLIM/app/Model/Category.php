<?php

namespace Model;

class Category extends Model
{
    use \Model\Traits\Category\Avatar;
    use \Model\Traits\Category\Init;
    use \Model\Traits\Category\URL;

    public $id; // int

    public $title; // string

    public $words; // string

    public $isRedirect = false; // bool
}
