<?php

class User_URL_Trait__getAvatarLargeURL__Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->setID(13);

        $this->assertEquals('https://octoanswers.com/uploads/avatar/13_400.jpg', $user->getAvatarLargeURL());
    }
}
