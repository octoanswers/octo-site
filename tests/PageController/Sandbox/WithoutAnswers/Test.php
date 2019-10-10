<?php

namespace Tests\PageController\Sandbox\WithoutAnswers;

class Test extends \Abstract_Frontend_TestCase
{
    protected $setUpDB = [
        'en' => ['questions', 'categories', 'revisions'],
        'ru' => ['questions', 'categories', 'revisions'], 'users' => ['users'],
    ];

    public function test__Show_EN_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/en/sandbox/without-answers',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Questions without answers – Page 1 – Answeropedia', $response_body);
        $this->assertStringContainsString('Do you like iPhone 6?', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Check_RU_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/sandbox/without-answers',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Вопросы без ответа – Страница 1 – Answeropedia', $response_body);
        $this->assertStringContainsString('Какая сейчас погода?', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }
}
