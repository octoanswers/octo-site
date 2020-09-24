<?php

namespace Model\Traits\Relation;

trait UserFollowCategory
{
    public static function initWithUserIDAndCategoryID(int $userID, int $categoryID): self
    {
        $er             = new self;
        $er->userID     = $userID;
        $er->categoryID = $categoryID;

        return $er;
    }

    public static function initWithDBState(array $state): self
    {
        $er = new self;

        $er->id         = (int) $state['id'];
        $er->userID     = (int) $state['user_id'];
        $er->categoryID = (int) $state['category_id'];
        $er->createdAt  = $state['created_at'];

        return $er;
    }
}
