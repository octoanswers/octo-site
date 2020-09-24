<?php

namespace Model\Traits\Relation;

trait UserFollowQuestion
{
    public static function initWithUserIDAndQuestionID(int $userID, int $questionID): self
    {
        $er             = new self;
        $er->userID     = $userID;
        $er->questionID = $questionID;

        return $er;
    }

    public static function initWithDBState(array $state): self
    {
        $er = new self;

        $er->id         = (int) $state['id'];
        $er->userID     = (int) $state['user_id'];
        $er->questionID = (int) $state['question_id'];
        $er->createdAt  = $state['created_at'];

        return $er;
    }
}
