<?php

namespace Traits\Model\Subscription;

trait Init
{
    public static function init_with_DB_state(array $state): self
    {
        $s = new self();
        $s->id = $state['s_id'];
        $s->questionID = $state['s_question_id'];
        $s->email = $state['s_email'];
        $s->createdAt = $state['s_created_at'];

        return $s;
    }
}
