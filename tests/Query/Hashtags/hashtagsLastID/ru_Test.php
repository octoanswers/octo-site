<?php

class Hashtags_Query__hashtagsLastID_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_base()
    {
        $actualResponse = (new Hashtags_Query('ru'))->hashtagsLastID();
        $this->assertEquals(17, $actualResponse);
    }
}
