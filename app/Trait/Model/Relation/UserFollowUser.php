<?php

trait UserFollowUser_Relation_Model_Trait
{
    public static function init_with_user_ID_and_followed_user_ID(int $userID, int $followedUserID): self
    {
        $er = new self();
        $er->userID = $userID;
        $er->followedUserID = $followedUserID;

        return $er;
    }

    public static function init_with_DB_state(array $state): self
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->followedUserID = (int) $state['followed_user_id'];
        $er->createdAt = $state['created_at'];

        return $er;
    }
}
