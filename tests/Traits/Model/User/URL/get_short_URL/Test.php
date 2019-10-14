<?php

namespace Test\Traits\Model\User\URL\get_short_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__EN_short_URL()
    {
        $user = new \Model\User();
        $user->id = 135;

        $this->assertEquals('https://answeropedia.org/en/user/135', $user->get_short_URL('en'));
    }

    public function test__RU_short_URL()
    {
        $user = new \Model\User();
        $user->id = 13;

        $this->assertEquals('https://answeropedia.org/ru/user/13', $user->get_short_URL('ru'));
    }
}
