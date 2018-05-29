<?php

class Mapper_Topic_create_title_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_CreateWithEmptyTitle_throwException()
    {
        $topic = new Topic_Model();
        $topic->setTitle('');

        $this->expectExceptionMessage('Topic title param "" must have a length between 2 and 127');
        $topic = (new Topic_Mapper('ru'))->create($topic);
    }

    public function test_CreateWithTooShortTitle_throwException()
    {
        $topic = new Topic_Model();
        $topic->setTitle('x');

        $this->expectExceptionMessage('Topic title param "x" must have a length between 2 and 127');
        $topic = (new Topic_Mapper('ru'))->create($topic);
    }

    public function test_CreateWithTooLongTitle_throwException()
    {
        $topic = new Topic_Model();
        $topic->setTitle('title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title');

        $this->expectExceptionMessage('Topic title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $topic = (new Topic_Mapper('ru'))->create($topic);
    }
}
