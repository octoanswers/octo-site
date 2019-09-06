<?php

class Signup_POST_APIController__negative__username__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_UsernameAlreadyExists()
    {
        $request = $this->__getTestRequest('POST', '/api/v1/ru/signup.json', 'username=kozel&email=new@answeropedia.org&password=jd754fJGFD99', true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User with username "kozel" is already registered',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testNameTooShort()
    {
        $request = $this->__getTestRequest('POST', '/api/v1/ru/signup.json', 'email=new@answeropedia.org&password=jd754fJGFD99&username=J', true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "username" property "J" must have a length between 3 and 64',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
