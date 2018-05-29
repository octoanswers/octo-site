<?php

class Logout_POST_APIController__BaseTest extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectLogout()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/api/v1/ru/logout.json',
            'QUERY_STRING' => 'api_key=9447243e3e1706375d23b06bf6dd1271',
            'CONTENT_TYPE' => 'application/json;charset=utf8',
            ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'message' => 'User unlogged',
            'destination_url' => 'http://octoanswers.com/ru'
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
