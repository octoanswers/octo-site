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

    public function getFirstTwoHashtags()
    {
        if (count($this->getHashtags()) >= 2) {
            $hashtags_slice = array_slice($this->getHashtags(), 0, 2);
        } else {
            $hashtags_slice = $this->getHashtags();
        }

        return $hashtags_slice;
    }

    public function getMinutesToRead():int
    {
        $answer_len = mb_strlen($this->answer->text);
        
        $minites_to_read = ceil($answer_len/1000);
        return $minites_to_read;
    }
    
    public function getMoreHashtagsCount(int $trimmedHashtagsCount = 2): int
    {
        $hashtagsCount = count($this->getHashtags());
        
        if ($hashtagsCount - $trimmedHashtagsCount <= 0) {
            return 0;
        }

        return $hashtagsCount - $trimmedHashtagsCount;
    }
}
