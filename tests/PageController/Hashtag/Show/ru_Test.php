<?php

class Show_Hashtag_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'hashtags', 'er_hashtags_questions', 'er_users_follow_hashtags']];

    public function test__ShowPage()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/ru/hashtag/13/Птицы',
        ]);
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $this->assertStringContainsString('<title>Вопросы и ответы на тему птицы - Answeropedia</title>', $responseBody);
        //$this->assertSame(200, $response->getStatusCode());
    }
}