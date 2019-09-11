<?php

class CategoriesToQuestions_Relation_Model extends Abstract_Model
{
    use CategoriesToQuestions_Relation_Model_Trait;

    public $id;
    public $categoryID;
    public $questionID;
    public $createdAt;
}
