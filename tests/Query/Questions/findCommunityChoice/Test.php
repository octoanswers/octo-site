<?php

namespace Test\Query\Questions\findCommunityChoice;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['questions_community_choice', 'questions']];

    public function test__Find_without_params()
    {
        $questions = (new \Query\Questions('en'))->findCommunityChoice();

        $this->assertEquals(10, count($questions));

        $this->assertEquals(9, $questions[0]->id);
        $this->assertEquals('Where lives answers?', $questions[0]->title);
        $this->assertEquals(null, $questions[0]->answer->text);

        $this->assertEquals(7, $questions[9]->id);
        $this->assertEquals('When all peoples be happy?', $questions[9]->title);
        $this->assertEquals('Hmm, it`s a long-long story...', $questions[9]->answer->text);
    }

    public function test__First_page()
    {
        $questions = (new \Query\Questions('en'))->findCommunityChoice(1);

        $this->assertEquals(10, count($questions));

        $this->assertEquals(9, $questions[0]->id);
        $this->assertEquals('Where lives answers?', $questions[0]->title);
        $this->assertEquals(null, $questions[0]->answer->text);

        $this->assertEquals(7, $questions[9]->id);
        $this->assertEquals('When all peoples be happy?', $questions[9]->title);
        $this->assertEquals('Hmm, it`s a long-long story...', $questions[9]->answer->text);
    }

    public function test__Second_page()
    {
        $questions = (new \Query\Questions('en'))->findCommunityChoice(2);

        $this->assertEquals(2, count($questions));

        $this->assertEquals(14, $questions[0]->id);
        $this->assertEquals('How are you?', $questions[0]->title);
        $this->assertEquals('I`m fine, bro!', $questions[0]->answer->text);

        $this->assertEquals(23, $questions[1]->id);
        $this->assertEquals('How US army trains scouts?', $questions[1]->title);
        $this->assertEquals(null, $questions[1]->answer->text);
    }
}
