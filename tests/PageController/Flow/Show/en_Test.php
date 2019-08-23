<?php

class Show_Flow_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['activities']];

    public function test__ShowENPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/flow',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Flow – Answeropedia', $response_body);

        //$this->assertStringNotContainsString('NEED_TRANSLATE', $response_body);
        $this->assertSame(200, $response->getStatusCode());
    }
}
