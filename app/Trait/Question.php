<?php

trait Question_Trait
{


    public function getMinutesToRead(): integer
    {
        $answer_len = mb_strlen($this->answer->text);

        $minites_to_read = ceil($answer_len / 1000);
        return $minites_to_read;
    }
}
