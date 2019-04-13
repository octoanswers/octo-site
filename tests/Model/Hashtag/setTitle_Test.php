<?php

class Model_Hashtag__setName_Test extends PHPUnit\Framework\TestCase
{
    public function test_setName_CorrectName()
    {
        $topic = new Topic_Model();
        $topic->setTitle('iPhone 8');

        $this->assertEquals('iPhone 8', $topic->getTitle());
    }

    public function test_setName_NameWithUnderline()
    {
        $topic = new Topic_Model();
        $topic->setTitle('MY_COOKIE');

        $this->assertEquals('MY_COOKIE', $topic->getTitle());
    }
}
