<?php

class QuestionsIDSubscribe_POST_APIController__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'questions_subscriptions']];

    public function test__BaseSubscription()
    {
        $query_string = 'email='.urlencode('data@test.ru').'&no_email=1';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/questions/17/subscribe.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang' => 'ru',
            'question_id' => 17,
            'question_title' => 'Кто владеет компаний Apple после смерти Стива Джобса?',
            'question_url' => 'https://answeropedia.org/ru/17/kto-vladeet-kompanii-apple-posle-smerti-stiva-dzhobsa',
            'subscription_id' => 5,
            'subscription_email' => 'data@test.ru',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__AlreadySubscribed()
    {
        $query_string = 'email='.urlencode('data@test.ru').'&no_email=1';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/questions/7/subscribe.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Email "data@test.ru" already subscribed to question with ID 7'
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
