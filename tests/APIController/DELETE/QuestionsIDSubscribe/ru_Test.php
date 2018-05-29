<?php

class QuestionsIDSubscribe_DELETE_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    public function test__BaseSubscription()
    {
        $query_string = 'email='.urlencode('test@mail.ru').'&no_email=1';
        $request = $this->__getTestRequest('DELETE', '/api/v1/ru/questions/12/subscribe.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'API not realized',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
