<?php

class Mapper_Question__updateCategoriesCount__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Base()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->categoriesCount = 2;

        $question = (new Question_Mapper('ru'))->updateCategoriesCount($question);

        $updatedQuestion = (new Question_Query('ru'))->question_with_ID(13);

        $this->assertEquals(13, $updatedQuestion->id);
        $this->assertEquals(2, $updatedQuestion->categoriesCount);
    }

    public function test__EmptyArray()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->categoriesCount = 0;

        $question = (new Question_Mapper('ru'))->updateCategoriesCount($question);

        $updatedQuestion = (new Question_Query('ru'))->question_with_ID(13);

        $this->assertEquals(13, $updatedQuestion->id);
        $this->assertEquals(0, $updatedQuestion->categoriesCount);
    }

    public function test__CategoriesNotSet()
    {
        $question = new Question_Model();
        $question->id = 13;

        $question = (new Question_Mapper('ru'))->updateCategoriesCount($question);

        $this->assertEquals(13, $question->id);
        $this->assertEquals(0, $question->categoriesCount);
    }
}
