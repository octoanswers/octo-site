<?php

namespace Test\Query\Questions\findRecentlyUpdated;

class EnTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Find_without_params()
    {
        $questions = (new \Query\Questions('en'))->findRecentlyUpdated();

        $this->assertEquals(9, count($questions));

        $this->assertEquals(14, $questions[0]->id);
        $this->assertEquals('How are you?', $questions[0]->title);
        $this->assertEquals('I`m fine, bro!', $questions[0]->answer->text);
    }
}
