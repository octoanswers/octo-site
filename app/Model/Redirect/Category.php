<?php

class Category_Redirect_Model extends Abstract_Model
{
    use Category_Redirect_Model_Trait;

    public $from_ID; // int
    public $to_title; // string
}
