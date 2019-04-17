<?php

class Validator_User__negative_site__Test extends PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $this->user = new User_Model();
        $this->user->setID(13);
        $this->user->username = 'boris';
        $this->user->name = 'Boris Bro';
        $this->user->email = 'steve@aw.org';
        $this->user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $this->user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
    }

    protected function tearDown()
    {
        $this->user = null;
    }

    public function test_HTTPSite()
    {
        $this->user->site = 'http://example.com';
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_HTTPSSite()
    {
        $this->user->site = 'https://example.com';
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_SiteWithURI()
    {
        $this->user->site = 'https://www.youtube.com/watch?v=6FOUqQt3Kg0';
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_SiteWithoutProtocol()
    {
        $this->user->site = 'example.com';

        $this->expectExceptionMessage('User "site" property "example.com" must be a URL');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_SiteWithWWW()
    {
        $this->user->site = 'www.example.com';

        $this->expectExceptionMessage('User "site" property "www.example.com" must be a URL');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_SiteIsNotURL()
    {
        $this->user->site = 'example_com';

        $this->expectExceptionMessage('User "site" property "example_com" must be a URL');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_SiteIsIncorrect()
    {
        $this->user->site = 'http:/example.com';

        $this->expectExceptionMessage('User "site" property "http:/example.com" must be a URL');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }
}
