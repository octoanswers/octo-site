<?php

namespace Test\Traits\Model\User\URL\getURLWithoutLang;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__URL_without_lang()
    {
        $user = new \Model\User();
        $user->username = 'foobar';

        $this->assertEquals('https://answeropedia.org/foobar', $user->getURLWithoutLang());
    }
}
