<?php

trait Question_Trait
{
    function getShortAnswer()
    {
        if ($this->getAnswer()->getText()) {
            return mb_substr($this->getAnswer()->getText(), 0, mb_strpos($this->getAnswer()->getText(), "\n"));
        }

        return null;
    }
}
