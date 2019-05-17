<?php

class PageNotFound_Error_PageController__en__Test extends Abstract_Frontend_TestCase
{
    public function test_Base()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/settings/some_unfounded_page'
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Ошибка 404 — Ансверопедия', $responseBody);
        $this->assertSame(404, $response->getStatusCode());
    }
}
