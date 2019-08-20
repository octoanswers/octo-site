<?php

class Show_Main_PageController__BaseTest extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'revisions', 'categories'], 'users' => ['users']];

    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Answeropedia', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
