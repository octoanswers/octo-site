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

    public function getFirstTwoCategories()
    {
        if (count($this->getCategories()) >= 2) {
            $categories_slice = array_slice($this->getCategories(), 0, 2);
        } else {
            $categories_slice = $this->getCategories();
        }

        return $categories_slice;
    }

    public function getMinutesToRead():int
    {
        $answer_len = mb_strlen($this->answer->text);
        
        $minites_to_read = ceil($answer_len/1000);
        return $minites_to_read;
    }
    
    public function getMoreCategoriesCount(int $trimmedCategoriesCount = 2): int
    {
        $categoriesCount = count($this->getCategories());
        
        if ($categoriesCount - $trimmedCategoriesCount <= 0) {
            return 0;
        }

        return $categoriesCount - $trimmedCategoriesCount;
    }
}
