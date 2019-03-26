<?php

class User_URL_Trait__getAvatarMediumURL__Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->setID(13);

        $this->assertEquals('https://answeropedia.org/uploads/avatar/13_200.jpg', $user->getAvatarMediumURL());
    }
}
