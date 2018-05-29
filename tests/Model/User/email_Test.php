<?php

class Model_User_email_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->setEmail('boris@octoanswers.com');

        $this->assertEquals('boris@octoanswers.com', $user->getEmail());
    }
}
