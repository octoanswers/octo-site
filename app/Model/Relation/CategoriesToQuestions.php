<?php

class CategoriesToQuestions_Relation_Model extends Abstract_Model
{
    public $id;
    public $categoryID;
    public $questionID;
    public $createdAt;

    #
    # Init methods
    #

    public static function initWithCategoryIDAndQuestionID(int $categoryID, int $questionID): CategoriesToQuestions_Relation_Model
    {
        $er = new self();
        $er->categoryID = $categoryID;
        $er->questionID = $questionID;

        return $er;
    }

    public static function initWithDBState(array $state): CategoriesToQuestions_Relation_Model
    {
        $er = new self();

        $er->id = $state['er_id'];
        $er->categoryID = $state['er_category_id'];
        $er->questionID = $state['er_question_id'];
        $er->createdAt = $state['er_created_at'];

        return $er;
    }
}
