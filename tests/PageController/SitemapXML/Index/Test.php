<?php

class Index_SitemapXML_PageController__Test extends Abstract_Frontend_TestCase
{
    public function test__Base()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/sitemap.xml',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('https://answeropedia.org/en', $responseBody);
        $this->assertStringContainsString('https://answeropedia.org/ru', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
