<?php

class Model_Hashtag__initWithDBState_Test extends PHPUnit\Framework\TestCase
{
    public function test_initWithDBState_FullEnParams_ReturnObj()
    {
        $hashtag = Hashtag_Model::initWithDBState([
            'h_id' => 13,
            'h_title' => 'virtual',
            'h_words' => 'cpu',
        ]);

        $this->assertEquals(13, $hashtag->getID());
        $this->assertEquals('virtual', $hashtag->title);
    }

    public function test_initWithDBState_FullRuParams_ReturnObj()
    {
        $hashtag = Hashtag_Model::initWithDBState([
            'h_id' => 231,
            'h_title' => 'медицинскиеуслуги',
            'h_words' => 'таблетка',
        ]);

        $this->assertEquals(231, $hashtag->getID());
        $this->assertEquals('медицинскиеуслуги', $hashtag->title);
    }
}
