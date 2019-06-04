<?php

class Newest_Questions_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions', 'categories', 'revisions'], 'users' => ['users']];

    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/questions/newest',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Newest questions · Page 1 · Answeropedia', $responseBody);
        $this->assertStringContainsString('What is main president daily function?', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
