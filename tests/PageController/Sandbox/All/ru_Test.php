<?php

class All_Sandbox_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'categories', 'revisions', 'redirects_questions'], 'users' => ['users']];

    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/ru/sandbox/all',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Песочница – Страница 1 – Answeropedia', $responseBody);
        $this->assertStringContainsString('Птицы играют в игры?', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
