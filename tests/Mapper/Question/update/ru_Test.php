<?php

class Mapper_Question__update__base__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_UpdateWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->id = 2;
        $question->title = 'This is question?';
        $question->isRedirect = true;
        $question->imageBaseName = '4_2013_05_09_123';

        $question = (new Question_Mapper('ru'))->update($question);

        $this->assertEquals(2, $question->id);
        $this->assertEquals('This is question?', $question->title);
        $this->assertEquals(true, $question->isRedirect);
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }

    public function test_UpdateWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->id = 4;
        $question->title = 'Ready to work?';

        $question = (new Question_Mapper('ru'))->update($question);

        $this->assertEquals(4, $question->id);
        $this->assertEquals('Ready to work?', $question->title);
        $this->assertEquals(false, $question->isRedirect);
        $this->assertEquals(null, $question->imageBaseName);
    }
}
