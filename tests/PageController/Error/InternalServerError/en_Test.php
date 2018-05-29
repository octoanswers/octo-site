<?php

class InternalServerError_Error_PageController__en__Test extends Abstract_Frontend_TestCase
{
    public function test_Base()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/question/667/rename'
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('Error 500 - OctoAnswers', $responseBody);
        $this->assertSame(500, $response->getStatusCode());
    }
}
