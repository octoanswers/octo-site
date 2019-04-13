<?php

class Model_Hashtag__setName_Test extends PHPUnit\Framework\TestCase
{
    public function test_setName_CorrectName()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setTitle('iPhone 8');

        $this->assertEquals('iPhone 8', $hashtag->getTitle());
    }

    public function test_setName_NameWithUnderline()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->setTitle('MY_COOKIE');

        $this->assertEquals('MY_COOKIE', $hashtag->getTitle());
    }
}
