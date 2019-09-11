<?php

trait UserFollowCategory_Relation_Model_Trait
{
    public static function init_with_user_ID_and_category_ID(int $userID, int $categoryID): self
    {
        $er = new self();
        $er->userID = $userID;
        $er->categoryID = $categoryID;

        return $er;
    }

    public static function init_with_DB_state(array $state): self
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->categoryID = (int) $state['category_id'];
        $er->createdAt = $state['created_at'];

        return $er;
    }
}
