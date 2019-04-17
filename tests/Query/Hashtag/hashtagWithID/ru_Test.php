<?php

class Hashtag_Query__hashtagWithID__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_CorrectHashtagID_ReturnHashtagObj()
    {
        $hashtag = (new Hashtag_Query('ru'))->hashtagWithID(6);

        $this->assertEquals(6, $hashtag->getID());
        $this->assertEquals('автоспорт', $hashtag->title);
    }
}
