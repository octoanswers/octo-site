<?php

class Show_Topic_PageController__ru__Test extends Abstract_Frontend_TestCase
{
    //protected $setUpDB = ['ru' => ['questions', 'topics', 'er_topics_questions', 'er_users_follow_topics']];

    public function test__XXX()
    {
        $this->assertSame(200, 200);
    }

    // @TODO
    // public function test__ShowRUPage()
    // {
    //     $environment = \Slim\Http\Environment::mock([
    //         'REQUEST_METHOD' => 'GET',
    //         'REQUEST_URI' => '/ru/topic/автоспорт',
    //     ]);
    //     $request = \Slim\Http\Request::createFromEnvironment($environment);
    //     $this->app->getContainer()['request'] = $request;
    //
    //     $response = $this->app->run(true);
    //     $responseBody = (string) $response->getBody();
    //
    //     $this->assertContains('Вопросы с хештегом #автоспорт - OctoAnswers', $responseBody);
    //     $this->assertSame(200, $response->getStatusCode());
    // }
}
