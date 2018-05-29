<?php

class User_URL_Helper__getShortURL__Test extends PHPUnit\Framework\TestCase
{
    public function test__en()
    {
        $user = new User_Model();
        $user->setID(135);

        $this->assertEquals('http://octoanswers.com/en/user/135', User_URL_Helper::getShortURL('en', $user));
    }

    public function test__ru()
    {
        $user = new User_Model();
        $user->setID(13);

        $this->assertEquals('http://octoanswers.com/ru/user/13', User_URL_Helper::getShortURL('ru', $user));
    }
}
