<?php

namespace Test\Mapper\Redirect\Question\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['redirects_questions']];

    public function test__Create_with_full_args()
    {
        $redirect = new \Model\Redirect\Question();
        $redirect->fromID = 12;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $redirect = (new \Mapper\Redirect\Question('ru'))->create($redirect);

        $this->assertEquals(12, $redirect->fromID);
        $this->assertEquals('How iPhone 8 are charged?', $redirect->toTitle);
    }
}
