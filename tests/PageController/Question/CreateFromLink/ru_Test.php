<?php

class CreateFromLink_Question_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    //protected $setUpDB = ['ru' => ['questions']];

    public function test__XXX()
    {
        $this->assertSame(200, 200);
    }

    // @TODO
    // public function test__ShowRUPage()
    // {
    //     $environment = \Slim\Http\Environment::mock([
    //         'REQUEST_METHOD' => 'GET',
    //         'REQUEST_URI' => '/ru/create/Как_отрастить_бороду',
    //     ]);
    //     $request = \Slim\Http\Request::createFromEnvironment($environment);
    //     $this->app->getContainer()['request'] = $request;
    //
    //     $response = $this->app->run(true);
    //     $responseBody = (string) $response->getBody();
    //
    //     $this->assertContains('Как отрастить бороду? - OctoAnswers', $responseBody);
    //     $this->assertSame(200, $response->getStatusCode());
    // }
}
