<?php

class Show_User_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions', 'revisions', 'er_users_follow_users'], 'users' => ['users']];

    public function test__EnPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/+kozel',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('Виталий Козлов Wiki-answers on Answeropedia', $responseBody);
        //$this->assertStringContainsString('Alexander Gomzyakov', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
