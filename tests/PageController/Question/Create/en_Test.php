<?php

class Create_Question_PageController__en__Test extends Abstract_Frontend_TestCase
{
    public function test__En()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/question/ask',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('Ask a question - OctoAnswers', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
