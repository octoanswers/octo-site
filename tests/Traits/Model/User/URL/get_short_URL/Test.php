<?php

namespace Test\Traits\Model\User\URL\getShortURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__EN_short_URL()
    {
        $user = new \Model\User();
        $user->id = 135;

        $this->assertEquals('https://answeropedia.org/en/user/135', $user->getShortURL('en'));
    }

    public function test__RU_short_URL()
    {
        $user = new \Model\User();
        $user->id = 13;

        $this->assertEquals('https://answeropedia.org/ru/user/13', $user->getShortURL('ru'));
    }
}
