<?php

class Mapper_Redirect__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['redirects']];

    public function test_CreateWithFullParams_Ok()
    {
        $redirect = new Redirect_Model();
        $redirect->setFromID(12);
        $redirect->setRedirectTitle('How iPhone 8 are charged?');

        $redirect = (new Redirect_Mapper('ru'))->create($redirect);

        $this->assertEquals(12, $redirect->getFromID());
        $this->assertEquals('How iPhone 8 are charged?', $redirect->getRedirectTitle());
    }
}
