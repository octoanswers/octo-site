<?php

class PageController_Error_InternalServerError__en__Test extends Abstract_Frontend_TestCase
{
    public function test_Base()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/answer/667/history',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Error 500 – Answeropedia', $response_body);

        $this->assertStringNotContainsString('NEED_TRANSLATE', $response_body);
        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(500, $response->getStatusCode());
    }
}
