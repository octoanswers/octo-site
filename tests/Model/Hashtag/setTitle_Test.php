<?php

class Model_Hashtag__setName_Test extends PHPUnit\Framework\TestCase
{
    public function test_setName_CorrectName()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->title = 'iPhone 8';

        $this->assertEquals('iPhone 8', $hashtag->title);
    }

    public function test_setName_NameWithUnderline()
    {
        $hashtag = new Hashtag_Model();
        $hashtag->title = 'MY_COOKIE';

        $this->assertEquals('MY_COOKIE', $hashtag->title);
    }
}
