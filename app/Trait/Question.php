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

    function getHumanizedMinutesToRead()
    {
        $answer_len = mb_strlen($this->getAnswer()->getText());
        if ($answer_len) {
            $minites_to_read = ceil($answer_len/1000);
            $humanized_minutes_to_read = $minites_to_read.' '.mb_strtolower(ngettext("Minute to read", "Minutes to read", $minites_to_read));
            return $humanized_minutes_to_read;
        }

        return _('Empty answer');
    }
}
