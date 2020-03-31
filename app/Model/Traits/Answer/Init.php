<?php

namespace Model\Traits\Answer;

trait Init
{
    public static function initWithDBState(array $state): self
    {
        $answer = new self;

        $answer->id        = (int) $state['q_id'];
        $answer->text      = $state['a_text'];
        $answer->updatedAt = $state['a_updated_at'];

        return $answer;
    }
}
