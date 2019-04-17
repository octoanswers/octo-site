<?php

class Model_User_timestamp_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->createdAt = '2016-03-19 06:47:41';

        $this->assertEquals('2016-03-19 06:47:41', $user->createdAt);
    }
}
