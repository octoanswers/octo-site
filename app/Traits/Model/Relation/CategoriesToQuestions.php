<?php

namespace Traits\Model\Relation;

trait CategoriesToQuestions
{
    public static function initWithCategoryIDAndQuestionID(int $categoryID, int $questionID): self
    {
        $relation = new self();

        $relation->categoryID = $categoryID;
        $relation->questionID = $questionID;

        return $relation;
    }

    public static function initWithDBState(array $state): self
    {
        $relation = new self();

        $relation->id = (int) $state['er_id'];
        $relation->categoryID = (int) $state['er_category_id'];
        $relation->questionID = (int) $state['er_question_id'];
        $relation->createdAt = $state['er_created_at'];

        return $relation;
    }
}
