<?php

class Model_User_name_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->setName('Boris Britva');

        $this->assertEquals('Boris Britva', $user->getName());
    }
}
