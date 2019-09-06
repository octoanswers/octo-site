<?php

class QuestionsIDSubscribe_POST_APIController__negative__question_id__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'questions_subscriptions']];

    public function test__QuestionNotExists()
    {
        $query_string = 'email=' . urlencode('data@test.ru') . '&no_email=1';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/questions/236/subscribe.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 1,
            'error_message' => 'Question with ID "236" not exists',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__QuestionIDEqualZero()
    {
        $query_string = 'email=' . urlencode('test@mail.ru') . '&no_email=1';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/questions/0/subscribe.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Question id param 0 must be greater than or equal to 1',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__QuestionIDBelowZero()
    {
        $query_string = 'email=' . urlencode('test@mail.ru') . '&no_email=1';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/questions/-1/subscribe.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Question id param -1 must be greater than or equal to 1',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
