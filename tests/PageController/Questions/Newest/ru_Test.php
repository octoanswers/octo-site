<?php

class Newest_Questions_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'hashtags', 'revisions'], 'users' => ['users']];

    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/ru/questions/newest',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Новые вопросы · Страница 1 · Answeropedia', $responseBody);
        $this->assertStringContainsString('Птицы играют в игры?', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
