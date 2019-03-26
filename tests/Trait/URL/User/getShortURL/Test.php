<?php

class User_URL_Trait__getShortURL__Test extends PHPUnit\Framework\TestCase
{
    public function test__en()
    {
        $user = new User_Model();
        $user->setID(135);

        $this->assertEquals('https://answeropedia.org/en/user/135', $user->getShortURL('en'));
    }

    public function test__ru()
    {
        $user = new User_Model();
        $user->setID(13);

        $this->assertEquals('https://answeropedia.org/ru/user/13', $user->getShortURL('ru'));
    }
}
