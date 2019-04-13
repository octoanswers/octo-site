<?php

class Model_Hashtag__setID_Test extends PHPUnit\Framework\TestCase
{
    public function test_setID_Ok()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setID(13);

        $this->assertEquals(13, $hashtag->getID());
    }
}
