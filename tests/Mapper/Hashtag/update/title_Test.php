<?php

class Mapper_Hashtag_update_title_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_UpdateWithEmptyTitle_throwException()
    {
        $topic = new Hashtag_Model();
        $topic->setID(2);
        $topic->setTitle('');

        $this->expectExceptionMessage('Topic title param "" must have a length between 2 and 127');
        $topic = (new Hashtag_Mapper('ru'))->update($topic);
    }

    public function test_TitleTooShort_throwException()
    {
        $topic = new Hashtag_Model();
        $topic->setID(2);
        $topic->setTitle('x');

        $this->expectExceptionMessage('Topic title param "x" must have a length between 2 and 127');
        $topic = (new Hashtag_Mapper('ru'))->update($topic);
    }

    public function test_UpdateWithTooLongTitle_throwException()
    {
        $topic = new Hashtag_Model();
        $topic->setID(2);
        $topic->setTitle('title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title');

        $this->expectExceptionMessage('Topic title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $topic = (new Hashtag_Mapper('ru'))->update($topic);
    }
}
