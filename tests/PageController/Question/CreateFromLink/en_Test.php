<?php

class CreateFromLink_Question_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__En()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/question/create/This_is_new_question_0235',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertContains('Create question: This is new question 0235? — OctoAnswers', $responseBody);
        //$this->assertContains('Alexander Gomzyakov', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__QuestionAlreadyExists()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/question/create/Where_i_am_born',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertSame(301, $response->getStatusCode());
    }
}
