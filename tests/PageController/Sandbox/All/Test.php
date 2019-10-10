<?php

namespace Tests\PageController\Sandbox\All;

class Test extends \Abstract_Frontend_TestCase
{
    protected $setUpDB = [
        'en' => ['questions', 'categories', 'revisions', 'redirects_questions'],
        'ru' => ['questions', 'categories', 'revisions', 'redirects_questions'], 'users' => ['users'],
    ];

    public function test__Show_EN_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/sandbox/all',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Sandbox – Page 1 – Answeropedia', $response_body);
        $this->assertStringContainsString('What is main president daily function?', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/sandbox/all',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);

        $this->assertSame(200, $response->getStatusCode());
    }
}
