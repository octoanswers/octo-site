<?php

class User_URL_Trait__get_short_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test__en()
    {
        $user = new User_Model();
        $user->id = 135;

        $this->assertEquals('https://answeropedia.org/en/user/135', $user->get_short_URL('en'));
    }

    public function test__ru()
    {
        $user = new User_Model();
        $user->id = 13;

        $this->assertEquals('https://answeropedia.org/ru/user/13', $user->get_short_URL('ru'));
    }
}
