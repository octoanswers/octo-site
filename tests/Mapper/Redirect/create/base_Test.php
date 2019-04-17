<?php

class Mapper_Redirect__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['redirects']];

    public function test_CreateWithFullParams_Ok()
    {
        $redirect = new Redirect_Model();
        $redirect->fromID = 12;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $redirect = (new Redirect_Mapper('ru'))->create($redirect);

        $this->assertEquals(12, $redirect->fromID);
        $this->assertEquals('How iPhone 8 are charged?', $redirect->toTitle);
    }
}
