<?php

namespace Model;

class Question extends Model
{
    use \Model\Traits\Question\Init;
    use \Model\Traits\Question\Humanize;
    use \Model\Traits\Question\URL;
    use \Model\Traits\Question\Image;

    public $id; // int

    public $title; // string

    public $isRedirect = false; // bool

    public $answer; // Answer_Model

    public $imageBaseName;

    public $categoriesCount; // int
}
