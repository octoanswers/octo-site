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
        if (count($this->hashtags) >= 2) {
            $hashtags_slice = array_slice($this->hashtags, 0, 2);
        } else {
            $hashtags_slice = $this->hashtags;
        }

        return $hashtags_slice;
    }

    public function getMinutesToRead():int
    {
        $answer_len = mb_strlen($this->answer->text);
        
        $minites_to_read = ceil($answer_len/1000);
        return $minites_to_read;
    }

    public function getHumanizedHashtags()
    {
        $hashtagsCount = count($this->getHashtags());
        
        if ($hashtagsCount == 0) {
            return _('No hashtags');
        }

        return $hashtagsCount . ' ' . mb_strtolower(ngettext("Hashtag", "Hashtags", $hashtagsCount));
    }
    
    public function getHumanizedMoreHashtags(int $trimmedHashtagsCount = 2): string
    {
        $hashtagsCount = count($this->getHashtags());
        
        if ($hashtagsCount - $trimmedHashtagsCount <= 0) {
            return '';
        }

        return $hashtagsCount - $trimmedHashtagsCount . ' ' . mb_strtolower(ngettext("Hashtag", "Hashtags", $hashtagsCount));
    }
}
