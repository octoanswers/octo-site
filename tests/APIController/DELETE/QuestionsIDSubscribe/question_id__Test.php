<?php

class QuestionsIDSubscribe_DELETE_APIController__question_id__Test extends \Tests\Frontend\TestCase
{
    public function test__Question_ID_equal_zero()
    {
        $query_string = '/api/v1/ru/questions/0/subscribe.json?email=' . urlencode('test@mail.ru') . '&no_email=1';

        $request = $this->createRequest('DELETE', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'API not realized',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Question_ID_below_zero()
    {
        $query_string = '/api/v1/ru/questions/-1/subscribe.json?email=' . urlencode('test@mail.ru') . '&no_email=1';

        $request = $this->createRequest('DELETE', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'API not realized',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
