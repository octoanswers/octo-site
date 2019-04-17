<?php

class Model_User_api_key_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->assertEquals('4447243e3e1766375d23b06bf6dd1271', $user->apiKey);
    }
}
