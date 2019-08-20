<?php

class Lang_SitemapXML_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'revisions', 'er_users_follow_users'], 'users' => ['users']];

    public function test__RuPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/sitemap.xml',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('https://answeropedia.org/ru/%D0%9F%D1%82%D0%B8%D1%86%D1%8B_%D0%B8%D0%B3%D1%80%D0%B0%D1%8E%D1%82_%D0%B2_%D0%B8%D0%B3%D1%80%D1%8B', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
