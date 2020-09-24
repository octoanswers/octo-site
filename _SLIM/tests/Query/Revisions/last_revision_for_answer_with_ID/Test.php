<?php

namespace Test\Query\Revisions\lastRevisionForAnswerWithID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['revisions']];

    public function test__Revision_exists()
    {
        $revision = (new \Query\Revisions('ru'))->lastRevisionForAnswerWithID(4);

        $this->assertEquals(4, $revision->id);
        $this->assertEquals(4, $revision->answerID);
        $this->assertEquals('c000d35i68', $revision->opcodes);
        $this->assertEquals('Last answer for question 4.', $revision->baseText);
        $this->assertEquals('Some rev comment', $revision->comment);
        $this->assertEquals(3, $revision->parentID);
    }

    public function test__Revision_not_exists()
    {
        $revision = (new \Query\Revisions('ru'))->lastRevisionForAnswerWithID(17);

        $this->assertEquals(null, $revision);
    }
}
