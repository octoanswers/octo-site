<?php

namespace Traits\Model\Question;

trait Humanize
{
    public function get_minutes_to_read(): int
    {
        $answer_len = mb_strlen($this->answer->text);

        $minites_to_read = ceil($answer_len / 1000);

        return (int) $minites_to_read;
    }
}
