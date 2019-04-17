<?php

class Mapper_Question_update_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_UpdateWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->setID(2);
        $question->setTitle('This is question?');
        $question->setRedirect(true);
        $question->imageBaseName = '4_2013_05_09_123';

        $question = (new Question_Mapper('ru'))->update($question);

        $this->assertEquals(2, $question->getID());
        $this->assertEquals('This is question?', $question->getTitle());
        $this->assertEquals(true, $question->isRedirect());
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }

    public function test_UpdateWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->setID(4);
        $question->setTitle('Ready to work?');

        $question = (new Question_Mapper('ru'))->update($question);

        $this->assertEquals(4, $question->getID());
        $this->assertEquals('Ready to work?', $question->getTitle());
        $this->assertEquals(false, $question->isRedirect());
        $this->assertEquals(null, $question->imageBaseName);
    }
}
