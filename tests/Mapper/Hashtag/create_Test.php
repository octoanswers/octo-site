<?php

class Mapper_Hashtag_createTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_Create_hashtag_with_EN_title()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'newhashtag';

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->id);
        $this->assertEquals('newhashtag', $hashtag->title);
    }

    public function test_Create_hashtag_with_RU_title()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'новаятема';

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->id);
        $this->assertEquals('новаятема', $hashtag->title);
    }
}
