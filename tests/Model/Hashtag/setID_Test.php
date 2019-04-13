<?php

class Model_Hashtag__setID_Test extends PHPUnit\Framework\TestCase
{
    public function test_setID_Ok()
    {
        $topic = new Topic_Model();
        $topic->setID(13);

        $this->assertEquals(13, $topic->getID());
    }
}
