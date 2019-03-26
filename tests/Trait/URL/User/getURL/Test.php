<?php

class User_URL_Trait__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test__en()
    {
        $user = new User_Model();
        $user->setUsername('vladimir');

        $this->assertEquals('https://answeropedia.org/en/+vladimir', $user->getURL('en'));
    }

    public function test__ru()
    {
        $user = new User_Model();
        $user->setUsername('foxy');

        $this->assertEquals('https://answeropedia.org/ru/+foxy', $user->getURL('ru'));
    }
}
