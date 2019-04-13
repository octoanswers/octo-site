<?php

class Model_Hashtag__initWithDBState_Test extends PHPUnit\Framework\TestCase
{
    public function test_initWithDBState_FullEnParams_ReturnObj()
    {
        $topic = Hashtag_Model::initWithDBState([
            't_id' => 13,
            't_title' => 'virtual',
            't_words' => 'cpu',
        ]);

        $this->assertEquals(13, $topic->getID());
        $this->assertEquals('virtual', $topic->getTitle());
    }

    public function test_initWithDBState_FullRuParams_ReturnObj()
    {
        $topic = Hashtag_Model::initWithDBState([
            't_id' => 231,
            't_title' => 'медицинскиеуслуги',
            't_words' => 'таблетка',
        ]);

        $this->assertEquals(231, $topic->getID());
        $this->assertEquals('медицинскиеуслуги', $topic->getTitle());
    }
}
