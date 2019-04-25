<?php

class Mapper_Hashtag_update_negativeTitleTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_Exception_when_title_is_empty()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 2;
        $hashtag->title = '';

        $this->expectExceptionMessage('Hashtag title param "" must have a length between 2 and 127');
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }

    public function test_Exception_when_title_too_short()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 2;
        $hashtag->title = 'x';

        $this->expectExceptionMessage('Hashtag title param "x" must have a length between 2 and 127');
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }

    public function test_Exception_when_title_too_long()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 2;
        $hashtag->title = 'title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title';

        $this->expectExceptionMessage('Hashtag title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }
}
