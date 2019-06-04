<?php

trait Question_Trait
{
    public function getShortAnswer()
    {
        if ($this->answer->text) {
            return mb_substr($this->answer->text, 0, mb_strpos($this->answer->text, "\n"));
        }

        return null;
    }

    public function getMinutesToRead():int
    {
        $answer_len = mb_strlen($this->answer->text);
        
        $minites_to_read = ceil($answer_len/1000);
        return $minites_to_read;
    }
}
