<?php

class Lang_SitemapXML_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'revisions', 'er_users_follow_users'], 'users' => ['users']];

    public function test__RuPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/ru/sitemap.xml',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('https://answeropedia.org/ru/16/kak-chasto-pticy-poyut-pesni', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
