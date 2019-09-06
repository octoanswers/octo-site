<?php

class Mapper_Question__create__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_CreateWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->title = 'This is question?';
        $question->isRedirect = true;
        $question->imageBaseName = '4_2013_05_09_123';

        $question = (new Question_Mapper('ru'))->create($question);

        $this->assertEquals(34, $question->id);
        $this->assertEquals('This is question?', $question->title);
        $this->assertEquals(true, $question->isRedirect);
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }

    public function test_CreateWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->title = 'Ready to work?';

        $question = (new Question_Mapper('ru'))->create($question);

        $this->assertEquals(34, $question->id);
        $this->assertEquals('Ready to work?', $question->title);
        $this->assertEquals(false, $question->isRedirect);
        $this->assertEquals(null, $question->imageBaseName);
    }
}
