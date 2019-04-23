<?php

class Lang_SitemapXML_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions', 'revisions', 'er_users_follow_users'], 'users' => ['users']];

    public function test__EnPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/sitemap.xml',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('https://answeropedia.org/en/25/what-s-iphone-6-price', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
