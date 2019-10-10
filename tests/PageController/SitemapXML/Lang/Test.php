<?php

namespace Tests\PageController\SitemapXML\Lang;

class Test extends \Abstract_Frontend_TestCase
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'er_users_follow_users'],
        'ru'    => ['questions', 'revisions', 'er_users_follow_users'],
        'users' => ['users'],
    ];

    public function test__EN_sitemap()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/sitemap.xml',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('https://answeropedia.org/en/How_developers_made_interesting_games', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__RU_sitemap()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/sitemap.xml',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);

        $this->assertSame(200, $response->getStatusCode());
    }
}
