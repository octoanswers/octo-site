<?php

class User_URL_Trait__get_avatar_URL_small__Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $user = new User_Model();
        $user->id = 13;

        $this->assertEquals('https://answeropedia.org/uploads/avatar/13_100.jpg', $user->get_avatar_URL_small());
    }
}
