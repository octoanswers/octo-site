<?php

class Category_Model extends Abstract_Model
{
    use Init_Category_Model_Trait;
    use URL_Category_Model_Trait;

    public $id; // int
    public $title; // string
    public $words; // string
    public $isRedirect = false; // bool
}
