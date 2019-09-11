<?php

class Trait_Model_User_URL__get_avatar_URL_largeTest extends PHPUnit\Framework\TestCase
{
    public function test__Default_avatar()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->name = 'Sasha';

        $this->assertEquals('https://avatars.answeropedia.org/avatars/user.png?size=400&name=Sasha', $user->get_avatar_URL_large());
    }

    public function test__Avatar_uploaded()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->name = 'Sasha';
        $user->is_avatar_uploaded = true;

        $this->assertEquals('https://answeropedia.org/uploads/avatar/13_400.jpg', $user->get_avatar_URL_large());
    }
}
