<?php

trait CategoriesToQuestions_Relation_Model_Trait
{
    public static function init_with_category_ID_and_question_ID(int $categoryID, int $questionID): self
    {
        $relation = new self();

        $relation->categoryID = $categoryID;
        $relation->questionID = $questionID;

        return $relation;
    }

    public static function init_with_DB_state(array $state): self
    {
        $relation = new self();

        $relation->id = (int) $state['er_id'];
        $relation->categoryID = (int) $state['er_category_id'];
        $relation->questionID = (int) $state['er_question_id'];
        $relation->createdAt = $state['er_created_at'];

        return $relation;
    }
}
