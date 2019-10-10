<?php

namespace Tests\PageController\Answer\Edit;

class Test extends \Abstract_Frontend_TestCase
{
    protected $setUpDB = [
        'en' => ['questions'],
        'ru' => ['questions'],
    ];

    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/answer/13/edit',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('What is you dream? – Edit answer – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/answer/13/edit',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);

        $this->assertSame(200, $response->getStatusCode());
    }
}
