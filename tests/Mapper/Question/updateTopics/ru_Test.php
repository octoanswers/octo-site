<?php

class Mapper_Question__updateCategories__ru_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Base()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->categoriesJSON = '["iPhone8", "Apple"]';

        $question = (new Question_Mapper('ru'))->updateCategories($question);

        $this->assertEquals(13, $question->id);
        $this->assertEquals(2, count($question->getCategories()));
    }

    public function test__EmptyArray()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->setCategories([]);

        $question = (new Question_Mapper('ru'))->updateCategories($question);

        $this->assertEquals(13, $question->id);
        $this->assertEquals(0, count($question->getCategories()));
    }

    public function test__CategoriesNotSet()
    {
        $question = new Question_Model();
        $question->id = 13;

        $question = (new Question_Mapper('ru'))->updateCategories($question);

        $this->assertEquals(13, $question->id);
        $this->assertEquals(0, count($question->getCategories()));
    }
}
