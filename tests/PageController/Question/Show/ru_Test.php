<?php

class PageController_Question_Show_baseTest extends Abstract_Frontend_TestCase
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'categories', 'er_categories_questions'],
        'ru'    => ['questions', 'revisions', 'categories', 'er_categories_questions'],
        'users' => ['users'],
    ];

    public function test_Get_RU_page()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/%D0%9A%D0%B0%D0%BA_%D0%B4%D0%B5%D0%BB%D0%B0',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();
        //var_dump($responseBody);

        $this->assertStringContainsString('Как дела? – Answeropedia', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Get_page_with_double_underscore()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/Что_означает_FILE__NAME',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Что означает FILE_NAME? – Answeropedia', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Get_page_by_old_URL()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/ru/10/kak-otrastit-borodu',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertSame(301, $response->getStatusCode());
    }
}
