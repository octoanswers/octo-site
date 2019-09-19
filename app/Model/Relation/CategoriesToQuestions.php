<?php

namespace Model\Relation;

class CategoriesToQuestions extends \Model\Model
{
    use \Traits\Model\Relation\CategoriesToQuestions;

    public $id;
    public $categoryID;
    public $questionID;
    public $createdAt;
}
