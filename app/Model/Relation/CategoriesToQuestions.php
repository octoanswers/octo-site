<?php

namespace Model\Relation;

class CategoriesToQuestions extends \Model\Model
{
    use \CategoriesToQuestions_Relation_Model_Trait;

    public $id;
    public $categoryID;
    public $questionID;
    public $createdAt;
}
