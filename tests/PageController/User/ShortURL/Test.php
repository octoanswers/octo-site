<?php

namespace Tests\PageController\User\ShortURL;

class Test extends \Abstract_Frontend_TestCase
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'er_users_follow_users'],
        'ru'    => ['questions', 'revisions', 'er_users_follow_users'],
        'users' => ['users'],
    ];

    public function test__EnPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/user/4',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);

        $this->assertSame(301, $response->getStatusCode());
    }

    public function test__Check_short_RU_URL()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/user/4',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);

        $this->assertSame(301, $response->getStatusCode());
    }
}
