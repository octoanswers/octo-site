<?php

class List_Hashtags_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['hashtags']];

    public function test__ShowENPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/hashtags/newest',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('New hashtags - Page 1 - Answeropedia', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
