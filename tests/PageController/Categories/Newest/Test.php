<?php

namespace Tests\PageController\Categories\Newest;

class Test extends \Abstract_Frontend_TestCase
{
    protected $setUpDB = [
        'en' => ['categories'],
        'ru' => ['categories'],
    ];

    public function test__Show_EN_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/categories/newest',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('New categories – Page 1 – Answeropedia', $response_body);

        $this->assertStringNotContainsString('NEED_TRANSLATE', $response_body);
        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/categories/newest',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);

        $this->assertSame(200, $response->getStatusCode());
    }
}
