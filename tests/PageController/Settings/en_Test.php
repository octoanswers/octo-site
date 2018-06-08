<?php

class Settings_PageController__en__Test extends Abstract_Frontend_TestCase
{
    public function test__ErrorForUnloggedUser()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/settings#avatar',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('You not logged', $responseBody);
        $this->assertSame(404, $response->getStatusCode());
    }

    public function test__ErrorForUnloggedUserOnSignature()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/settings#signature',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('You not logged', $responseBody);
        $this->assertSame(404, $response->getStatusCode());
    }
}
