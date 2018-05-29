<?php

class Mapper_Question_create_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_CreateWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->setTitle('This is question?');
        $question->setRedirect(true);
        $question->setImageBaseName('4_2013_05_09_123');

        $question = (new Question_Mapper('ru'))->create($question);

        $this->assertEquals(34, $question->getID());
        $this->assertEquals('This is question?', $question->getTitle());
        $this->assertEquals(true, $question->isRedirect());
        $this->assertEquals('4_2013_05_09_123', $question->getImageBaseName());
    }

    public function test_CreateWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->setTitle('Ready to work?');

        $question = (new Question_Mapper('ru'))->create($question);

        $this->assertEquals(34, $question->getID());
        $this->assertEquals('Ready to work?', $question->getTitle());
        $this->assertEquals(false, $question->isRedirect());
        $this->assertEquals(null, $question->getImageBaseName());
    }
}
