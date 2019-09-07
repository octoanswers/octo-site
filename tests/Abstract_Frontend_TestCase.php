<?php

abstract class Abstract_Frontend_TestCase extends Abstract_DB_TestCase
{
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = (new SlimApp())->get_app();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->app = null;
    }

    protected function __getTestRequest(string $requestMethod, string $requestURI, $queryString = null, $isJson = false)
    {
        $mockParams = [
            'REQUEST_METHOD' => $requestMethod,
            'REQUEST_URI'    => $requestURI,
        ];
        if ($queryString != null) {
            $mockParams['QUERY_STRING'] = $queryString;
        }
        if ($isJson) {
            $mockParams['CONTENT_TYPE'] = 'application/json;charset=utf8';
        }

        $environment = \Slim\Http\Environment::mock($mockParams);
        $request = \Slim\Http\Request::createFromEnvironment($environment);

        return $request;
    }
}
