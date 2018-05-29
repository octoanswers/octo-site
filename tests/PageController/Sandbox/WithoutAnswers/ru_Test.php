<?php

class WithoutAnswers_Sandbox_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'topics', 'revisions'], 'users' => ['users']];

    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/ru/sandbox/without-answers',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('Вопросы без ответов - Страница 1 - OctoAnswers', $responseBody);
        $this->assertContains('Какая сейчас погода?', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
