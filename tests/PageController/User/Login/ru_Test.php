<?php

class Login_User_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    public function testBase()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/ru/login',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('Вход на сервис вопросов и ответов - OctoAnswers', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
