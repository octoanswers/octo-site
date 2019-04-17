<?php

class Mapper_Hashtag_create_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_CreateWithEnTitle_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->title = 'newhashtag';

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->getID());
        $this->assertEquals('newhashtag', $hashtag->title);
    }

    public function test_CreateWithRuTitle_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->title = 'новаятема';

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->getID());
        $this->assertEquals('новаятема', $hashtag->title);
    }
}
