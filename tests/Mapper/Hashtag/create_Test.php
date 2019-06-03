<?php

class Mapper_Hashtag_createTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_Create_category_with_one_word_name()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'New';

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->id);
        $this->assertEquals('New', $hashtag->title);
    }

    public function test_Create_category_with_two_word_name()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'Foo Bar';

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->id);
        $this->assertEquals('Foo Bar', $hashtag->title);
    }

    public function test_Create_category_with_RU_title()
    {
        $hashtag = new Hashtag();
        $hashtag->title = 'тема';

        $hashtag = (new Hashtag_Mapper('ru'))->create($hashtag);

        $this->assertEquals(18, $hashtag->id);
        $this->assertEquals('тема', $hashtag->title);
    }
}
