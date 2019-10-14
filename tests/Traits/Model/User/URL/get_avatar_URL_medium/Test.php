<?php

namespace Test\Traits\Model\User\URL\getAvatarURLMedium;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Default_avatar()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->name = 'Sasha';

        $this->assertEquals('https://avatars.answeropedia.org/avatars/user.png?size=200&name=Sasha', $user->getAvatarURLMedium());
    }

    public function test__Avatar_uploaded()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->name = 'Sasha';
        $user->is_avatar_uploaded = true;

        $this->assertEquals('https://answeropedia.org/uploads/avatar/13_200.jpg', $user->getAvatarURLMedium());
    }
}
