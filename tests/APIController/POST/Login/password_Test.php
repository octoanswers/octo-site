<?php

class Login_POST_APIController__NegativePasswordTest extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testPasswordTooShort()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI'    => '/api/v1/ru/login.json',
            'QUERY_STRING'   => 'email=admin@answeropedia.org&password=foo',
            'CONTENT_TYPE'   => 'application/json;charset=utf8',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "password" property "foo" must have a length between 6 and 32',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function testPasswordIsIncorrect()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI'    => '/api/v1/ru/login.json',
            'QUERY_STRING'   => 'email=admin@answeropedia.org&password=123456789',
            'CONTENT_TYPE'   => 'application/json;charset=utf8',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 1,
            'error_message' => 'WRONG_PASSWORD',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
