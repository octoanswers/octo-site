<?php

class Newest_Users_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_base()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/users/newest',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('New users from around the world · Page 0 · Answeropedia', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
