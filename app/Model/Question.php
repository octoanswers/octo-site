<?php

namespace Model;

class Question extends Model
{
    use \Init_Question_Model_Trait;
    use \Humanize_Question_Model_Trait;
    use \URL_Question_Model_Trait;
    use \Image_Question_Model_Trait;

    public $id; // int
    public $title; // string
    public $isRedirect = false; // bool
    public $answer; // Answer_Model
    public $imageBaseName;
    public $categoriesCount; // int
}
