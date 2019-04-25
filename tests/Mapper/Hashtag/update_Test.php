<?php

class Mapper_Hashtag_updateTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_Update_hashtag_with_EN_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 7;
        $hashtag->title = 'newhashtag';

        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);

        $this->assertEquals(7, $hashtag->id);
        $this->assertEquals('newhashtag', $hashtag->title);
    }

    public function test_Update_hashtag_with_RU_title()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 4;
        $hashtag->title = 'новаятема';

        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);

        $this->assertEquals(4, $hashtag->id);
        $this->assertEquals('новаятема', $hashtag->title);
    }
}
