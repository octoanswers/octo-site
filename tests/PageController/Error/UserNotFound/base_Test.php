<?php

class UserNotFound_Error_PageController__Test extends Abstract_Frontend_TestCase
{
    public function test_base()
    {
        $this->assertSame(404, 404);
    }

    // public function test_base()
    // {
    //     $environment = \Slim\Http\Environment::mock([
    //         'REQUEST_METHOD' => 'GET',
    //         'REQUEST_URI' => '/unexistsusername'
    //     ]);
    //     $request = \Slim\Http\Request::createFromEnvironment($environment);
    //     $this->app->getContainer()['request'] = $request;
    //
    //     $response = $this->app->run(true);
    //     $responseBody = (string) $response->getBody();
    //
    //     $this->assertStringContainsString('User not found: unexistsusername - Answeropedia', $responseBody);
    //     $this->assertSame(404, $response->getStatusCode());
    // }
    //
    // public function test_ru()
    // {
    //     $environment = \Slim\Http\Environment::mock([
    //         'REQUEST_METHOD' => 'GET',
    //         'REQUEST_URI' => '/unexistsusername/ru'
    //     ]);
    //     $request = \Slim\Http\Request::createFromEnvironment($environment);
    //     $this->app->getContainer()['request'] = $request;
    //
    //     $response = $this->app->run(true);
    //     $responseBody = (string) $response->getBody();
    //
    //     $this->assertStringContainsString('Пользователь не найден: unexistsusername - Answeropedia', $responseBody);
    //     $this->assertSame(404, $response->getStatusCode());
    // }
}
