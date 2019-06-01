<?php

class Unlogged_Main_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions', 'revisions', 'hashtags'], 'users' => ['users']];

    public function test_base()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Answeropedia · Ask a question and get one complete answer', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
