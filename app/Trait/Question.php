<?php

trait Question_Trait
{
    public function getShortAnswer()
    {
        if ($this->answer->getText()) {
            return mb_substr($this->answer->getText(), 0, mb_strpos($this->answer->getText(), "\n"));
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

    public function getHumanizedMinutesToRead()
    {
        $answer_len = mb_strlen($this->answer->getText());
        if ($answer_len) {
            $minites_to_read = ceil($answer_len/1000);
            $humanized_minutes_to_read = $minites_to_read.' '.mb_strtolower(ngettext("Minute to read", "Minutes to read", $minites_to_read));
            return $humanized_minutes_to_read;
        }

        return _('Empty answer');
    }

    public function getHumanizedHashtags()
    {
        $hashtagsCount = count($this->getTopics());
        
        if ($hashtagsCount == 0) {
            return _('No hashtags');
        }

        return $hashtagsCount . ' ' . mb_strtolower(ngettext("Hashtag", "Hashtags", $hashtagsCount));
    }
    
    public function getHumanizedMoreHashtags(int $trimmedHashtagsCount = 2): string
    {
        $hashtagsCount = count($this->getTopics());
        
        if ($hashtagsCount - $trimmedHashtagsCount <= 0) {
            return '';
        }

        return $hashtagsCount - $trimmedHashtagsCount . ' ' . mb_strtolower(ngettext("Hashtag", "Hashtags", $hashtagsCount));
    }
}
