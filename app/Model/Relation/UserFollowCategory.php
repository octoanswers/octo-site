<?php

class UserFollowCategory_Relation_Model extends Abstract_Model
{
    public $id;
    public $userID;
    public $categoryID;
    public $createdAt;

    #
    # Init methods
    #

    public static function initWithUserIDAndCategoryID(int $userID, int $categoryID): UserFollowCategory_Relation_Model
    {
        $er = new self();
        $er->userID = $userID;
        $er->categoryID = $categoryID;

        return $er;
    }

    public static function initWithDBState(array $state): UserFollowCategory_Relation_Model
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->categoryID = (int) $state['category_id'];
        $er->createdAt = $state['created_at'];

        return $er;
    }
}
