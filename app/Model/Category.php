<?php

class Category_Model extends Abstract_Model
{
    use Category_Model_Trait;
    use Category_URL_Trait;

    public $id; // int
    public $title; // string
    public $words; // string
    public $isRedirect = false; // bool
}
