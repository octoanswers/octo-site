<?php

namespace Test\Traits\Model\User\URL\getURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__EN_URL()
    {
        $user = new \Model\User();
        $user->username = 'vladimir';

        $this->assertEquals('https://answeropedia.org/en/vladimir', $user->getURL('en'));
    }

    public function test__RU_URL()
    {
        $user = new \Model\User();
        $user->username = 'foxy';

        $this->assertEquals('https://answeropedia.org/ru/foxy', $user->getURL('ru'));
    }
}
