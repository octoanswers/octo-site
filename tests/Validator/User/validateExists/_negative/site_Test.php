<?php

class Validator_User__validate_exists__negative__siteTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->user = new \Model\User();
        $this->user->id = 13;
        $this->user->username = 'boris';
        $this->user->name = 'Boris Bro';
        $this->user->email = 'steve@aw.org';
        $this->user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $this->user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
    }

    protected function tearDown(): void
    {
        $this->user = null;
    }

    public function test__HTTP_site()
    {
        $this->user->site = 'http://example.com';
        $this->assertEquals(true, \Validator\User::validate_exists($this->user));
    }

    public function test__HTTPS_site()
    {
        $this->user->site = 'https://example.com';
        $this->assertEquals(true, \Validator\User::validate_exists($this->user));
    }

    public function test__Site_with_URI()
    {
        $this->user->site = 'https://www.youtube.com/watch?v=6FOUqQt3Kg0';
        $this->assertEquals(true, \Validator\User::validate_exists($this->user));
    }

    public function test__Site_without_protocol()
    {
        $this->user->site = 'example.com';

        $this->expectExceptionMessage('User "site" property "example.com" must be a URL');
        $this->assertEquals(true, \Validator\User::validate_exists($this->user));
    }

    public function test__Site_with_WWW()
    {
        $this->user->site = 'www.example.com';

        $this->expectExceptionMessage('User "site" property "www.example.com" must be a URL');
        $this->assertEquals(true, \Validator\User::validate_exists($this->user));
    }

    public function test__Site_is_not_URL()
    {
        $this->user->site = 'example_com';

        $this->expectExceptionMessage('User "site" property "example_com" must be a URL');
        $this->assertEquals(true, \Validator\User::validate_exists($this->user));
    }

    public function test__Site_URL_is_incorrect()
    {
        $this->user->site = 'http:/example.com';

        $this->expectExceptionMessage('User "site" property "http:/example.com" must be a URL');
        $this->assertEquals(true, \Validator\User::validate_exists($this->user));
    }
}
