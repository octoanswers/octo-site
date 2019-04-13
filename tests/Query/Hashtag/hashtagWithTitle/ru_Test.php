<?php

class Hashtag_Query__findWithTitle__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test__HastagExists()
    {
        $hashtag = (new Hashtag_Query('ru'))->findWithTitle('парфюмерия');

        $this->assertEquals(8, $hashtag->getID());
        $this->assertEquals('парфюмерия', $hashtag->getTitle());
    }

    public function test__HashtagNotExists()
    {
        $hashtag = (new Hashtag_Query('ru'))->findWithTitle('notexists');

        $this->assertEquals(null, $hashtag);
    }
}
