<?php

class Category extends Abstract_Model
{
    use Category_URL_Trait;

    public $id; // int
    public $title; // string
    public $words; // string

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Category
    {
        $category = new self();
        $category->title = $title;

        return $category;
    }

    public static function initWithDBState(array $state): Category
    {
        if (!isset($state['c_id']) || !isset($state['c_title'])) {
            throw new Exception("Category init with empty state", 1);
        }

        $category = new self();
        $category->id = (int) $state['c_id'];
        $category->title = (string) $state['c_title'];

        return $category;
    }
}
