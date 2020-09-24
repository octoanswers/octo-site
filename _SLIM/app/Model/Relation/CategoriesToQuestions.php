<?php

namespace Model\Relation;

class CategoriesToQuestions extends \Model\Model
{
    use \Model\Traits\Relation\CategoriesToQuestions;

    public $id;

    public $categoryID;

    public $questionID;

    public $createdAt;
}
