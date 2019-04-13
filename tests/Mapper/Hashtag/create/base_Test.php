<?php

class Mapper_Hashtag_create_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_CreateWithEnTitle_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setTitle('newhashtag');

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->getID());
        $this->assertEquals('newhashtag', $hashtag->getTitle());
    }

    public function test_CreateWithRuTitle_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setTitle('новаятема');

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->getID());
        $this->assertEquals('новаятема', $hashtag->getTitle());
    }
}
