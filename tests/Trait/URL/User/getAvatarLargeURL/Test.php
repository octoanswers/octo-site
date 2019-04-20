<?php

class User_URL_Trait__getAvatarLargeURL__Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->id = 13;

        $this->assertEquals('https://answeropedia.org/uploads/avatar/13_400.jpg', $user->getAvatarLargeURL());
    }
}
