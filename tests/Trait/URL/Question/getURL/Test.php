<?php

class Question_URL_Trait__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $question = new Question_Model();
        $question->setID(19);
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals('https://answeropedia.org/en/19/how-iphone-8-are-charged', $question->getURL('en'));
    }

    public function test_RuTitle()
    {
        $question = new Question_Model();
        $question->setID(18);
        $question->title = 'Можно ли сохранить массив в COOKIE?';

        $this->assertEquals('https://answeropedia.org/ru/18/mozhno-li-sohranit-massiv-v-cookie', $question->getURL('ru'));
    }
}
