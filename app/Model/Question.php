<?php

namespace Model;

class Question extends Model
{
    use \Traits\Model\Question\Init;
    use \Traits\Model\Question\Humanize;
    use \Traits\Model\Question\URL;
    use \Traits\Model\Question\Image;

    public $id; // int
    public $title; // string
    public $isRedirect = false; // bool
    public $answer; // Answer_Model
    public $imageBaseName;
    public $categoriesCount; // int
}
