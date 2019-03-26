<?php

class Login_POST_APIController__NegativeEmailTest extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testIncorrectEmail()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/api/v1/ru/login.json',
            'QUERY_STRING' => 'email=admin_answeropedia.org&password=jd754fJGFD99',
            'CONTENT_TYPE' => 'application/json;charset=utf8',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'User "email" property "admin_answeropedia.org" must be valid email',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function testEmailNotExists()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/api/v1/ru/login.json',
            'QUERY_STRING' => 'email=foo@bar.org&password=jd754fJGFD99',
            'CONTENT_TYPE' => 'application/json;charset=utf8',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 1,
            'error_message' => 'User with specific email not found',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
