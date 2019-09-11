<?php

class Trait_Model_Question_Image__get_image_URL_large__Test extends PHPUnit\Framework\TestCase
{
    public function test__Base_URL()
    {
        $question = new Question_Model();
        $question->id = 19;
        $question->imageBaseName = 'foo23';

        $this->assertEquals('https://answeropedia.org/uploads/img/en/19/foo23_lg.jpg', $question->get_image_URL_large('en'));
    }

    public function test__Base_RU_URL()
    {
        $question = new Question_Model();
        $question->id = 18;
        $question->imageBaseName = 'bar-12';

        $this->assertEquals('https://answeropedia.org/uploads/img/ru/18/bar-12_lg.jpg', $question->get_image_URL_large('ru'));
    }
}
