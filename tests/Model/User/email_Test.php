<?php

class Model_User_email_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->setEmail('boris@answeropedia.org');

        $this->assertEquals('boris@answeropedia.org', $user->getEmail());
    }
}
