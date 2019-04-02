<?php

class Show_Topic_PageController__en__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['en' => ['questions', 'topics', 'er_topics_questions', 'er_users_follow_topics']];

    public function test__ShowPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/en/topic/12/cashmere',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();
        
        $this->assertContains('<title>Questions and answers on the topic Cashmere - Answeropedia</title>', $responseBody);
        $this->assertSame(200, $response->getStatusCode());
    }
}
