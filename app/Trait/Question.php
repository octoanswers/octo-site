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

    public function getFirstTwoTopics()
    {
        if (count($this->topics) >= 2) {
            $topics_slice = array_slice($this->topics, 0, 2);
        } else {
            $topics_slice = $this->topics;
        }

        return $topics_slice;
    }
}
