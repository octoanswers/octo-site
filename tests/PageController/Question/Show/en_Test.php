<?php

class Show_Question_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions', 'revisions', 'categories']];

    public function test__ShowENPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/Where_i_am_born',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Where i am born? · Answeropedia', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
