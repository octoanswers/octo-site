<?php

class Question_Mapper_Redirect__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['redirects_questions']];

    public function test_CreateWithFullParams_Ok()
    {
        $redirect = new Question_Redirect_Model();
        $redirect->fromID = 12;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $redirect = (new Question_Redirect_Mapper('ru'))->create($redirect);

        $this->assertEquals(12, $redirect->fromID);
        $this->assertEquals('How iPhone 8 are charged?', $redirect->toTitle);
    }
}
