<?php

namespace Traits\Model\Relation;

trait UserFollowUser
{
    public static function initWithUserIDAndFollowedUserID(int $userID, int $followedUserID): self
    {
        $er = new self();
        $er->userID = $userID;
        $er->followedUserID = $followedUserID;

        return $er;
    }

    public static function initWithDBState(array $state): self
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->followedUserID = (int) $state['followed_user_id'];
        $er->createdAt = $state['created_at'];

        return $er;
    }
}
