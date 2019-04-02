<?php

class WithoutAnswers_Sandbox_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions', 'topics', 'revisions'], 'users' => ['users']];

    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/sandbox/without-answers',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('Questions without answers - Page 1 - Answeropedia', $responseBody);
        $this->assertContains('Do you like iPhone 6?', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
