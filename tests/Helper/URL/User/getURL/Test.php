<?php

class User_URL_Helper__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test__en()
    {
        $user = new User_Model();
        $user->setUsername('vladimir');

        $this->assertEquals('http://octoanswers.com/en/+vladimir', User_URL_Helper::getURL('en', $user));
    }

    public function test__ru()
    {
        $user = new User_Model();
        $user->setUsername('foxy');

        $this->assertEquals('http://octoanswers.com/ru/+foxy', User_URL_Helper::getURL('ru', $user));
    }
}
