<?php

class Mapper_Hashtag_update_id_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_UpdateWithNotExistsID_ThrowException()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(2215);
        $hashtag->setTitle('impossible');

        $this->expectExceptionMessage("Hashtag with ID 2215 not exists");
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }

    public function test_UpdateWithIDEqualZero_ThrowException()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(0);
        $hashtag->setTitle('car');

        $this->expectExceptionMessage('Hashtag id param 0 must be greater than or equal to 1');
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }

    public function test_UpdateWithIDBelowZero_ThrowException()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(-1);
        $hashtag->setTitle('guf');

        $this->expectExceptionMessage('Hashtag id param -1 must be greater than or equal to 1');
        $hashtag = (new Hashtag_Mapper('ru'))->update($hashtag);
    }
}
