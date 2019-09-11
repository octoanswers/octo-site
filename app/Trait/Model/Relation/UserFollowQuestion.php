<?php

trait UserFollowQuestion_Relation_Model_Trait
{
    public static function init_with_user_ID_and_question_ID(int $userID, int $questionID): self
    {
        $er = new self();
        $er->userID = $userID;
        $er->questionID = $questionID;

        return $er;
    }

    public static function init_with_DB_state(array $state): self
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->questionID = (int) $state['question_id'];
        $er->createdAt = $state['created_at'];

        return $er;
    }
}
