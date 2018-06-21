<?php

class Login_POST_APIController__BaseTest extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectLogin()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/api/v1/ru/login.json',
            'QUERY_STRING' => 'email=admin@octoanswers.com&password=jd754fJGFD99',
            'CONTENT_TYPE' => 'application/json;charset=utf8',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang' => 'ru',
            'id' => 3,
            'email' => 'admin@octoanswers.com',
            'name' => 'Иван Коршунов',
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'created_at' => '2016-03-19 06:47:41',
            'url' => 'https://octoanswers.com/ru/+ivan',
            'destination_url' => 'https://octoanswers.com/ru'
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
