<?php

class Question_Redirect_Model extends Abstract_Model
{
    use Question_Redirect_Model_Trait;

    public $fromID; // int
    public $toTitle; // string
}
