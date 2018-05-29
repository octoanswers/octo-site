<?php

class Signup_POST_APIController__email_Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testEmailIsIncorrect()
    {
        $request = $this->__getTestRequest('POST', '/api/v1/ru/signup.json', 'email=foo_octoanswers.com&password=jd754fJGFD99&username=ivanivanov', true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
        'error_code' => 0,
        'error_message' => 'User "email" property "foo_octoanswers.com" must be valid email',
    ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testEmailAlreadyRegistered()
    {
        $request = $this->__getTestRequest('POST', '/api/v1/ru/signup.json', 'email=admin@octoanswers.com&password=jd754fJGFD99&username=ivanivanov', true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
        'error_code' => 1,
        'error_message' => 'User with specific email is already registered',
    ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
