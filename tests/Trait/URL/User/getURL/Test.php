<?php

class User_URL_Trait__get_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test__en()
    {
        $user = new User_Model();
        $user->username = 'vladimir';

        $this->assertEquals('https://answeropedia.org/en/@vladimir', $user->get_URL('en'));
    }

    public function test__ru()
    {
        $user = new User_Model();
        $user->username = 'foxy';

        $this->assertEquals('https://answeropedia.org/ru/@foxy', $user->get_URL('ru'));
    }
}
