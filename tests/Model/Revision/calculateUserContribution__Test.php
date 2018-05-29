<?php

class Model_Revision__getUserContribution__Test extends PHPUnit\Framework\TestCase
{
    public function test__TwoInsertionAndOneDeletion()
    {
        $revision = new Revision_Model();
        $revision->setOpcodes("c73d22i65:[агиографии](Что такое агиография?), c1178i187:Труды Аббона по логике не удостоились славы, но заложили прочный фундамент для будущий исследований.\n\nc37");

        $this->assertEquals("c73d22i65:[агиографии](Что такое агиография?), c1178i187:Труды Аббона по логике не удостоились славы, но заложили прочный фундамент для будущий исследований.\n\nc37", $revision->getOpcodes());
        $this->assertEquals(274, $revision->getUserContribution());
    }

    public function test__OneInsertionAndOneDeletion()
    {
        $revision = new Revision_Model();
        $revision->setOpcodes("c1180d23i166:монастырям. Именно так, в настоящее время, аббатства показываются в современной культуре.\n\nc33");

        $this->assertEquals("c1180d23i166:монастырям. Именно так, в настоящее время, аббатства показываются в современной культуре.\n\nc33", $revision->getOpcodes());
        $this->assertEquals(189, $revision->getUserContribution());
    }

    public function test__EmptyOpcodes()
    {
        $revision = new Revision_Model();
        $revision->setOpcodes("");

        $this->assertEquals("", $revision->getOpcodes());
        $this->assertEquals(0, $revision->getUserContribution());
    }

    public function test__OpcodesNotSet()
    {
        $revision = new Revision_Model();

        $this->assertEquals("", $revision->getOpcodes());
        $this->assertEquals(0, $revision->getUserContribution());
    }
}
