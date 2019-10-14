<?php

namespace Test\Traits\Model\Question\Image\getImageURLLarge;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Base_URL()
    {
        $question = new \Model\Question();
        $question->id = 19;
        $question->imageBaseName = 'foo23';

        $this->assertEquals('https://answeropedia.org/uploads/img/en/19/foo23_lg.jpg', $question->getImageURLLarge('en'));
    }

    public function test__Base_RU_URL()
    {
        $question = new \Model\Question();
        $question->id = 18;
        $question->imageBaseName = 'bar-12';

        $this->assertEquals('https://answeropedia.org/uploads/img/ru/18/bar-12_lg.jpg', $question->getImageURLLarge('ru'));
    }
}
