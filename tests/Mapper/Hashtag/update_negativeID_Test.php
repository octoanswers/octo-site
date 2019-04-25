<?php

class Mapper_Hashtag_update_negativeIDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_Exception_when_hashtag_ID_not_exists()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 2215;
        $hashtag->title = 'impossible';

        $this->expectExceptionMessage("Hashtag with ID 2215 not exists");
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }

    public function test_Exception_when_hashtag_ID_equal_zero()
    {
        $hashtag = new Hashtag();
        $hashtag->id = 0;
        $hashtag->title = 'car';

        $this->expectExceptionMessage('Hashtag id param 0 must be greater than or equal to 1');
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }

    public function test_Exception_when_hashtag_ID_below_zero()
    {
        $hashtag = new Hashtag();
        $hashtag->id = -1;
        $hashtag->title = 'guf';

        $this->expectExceptionMessage('Hashtag id param -1 must be greater than or equal to 1');
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }
}
