<?php

class QuestionsIDSubscribe_DELETE_APIController__email__Test extends \Test\TestCase\Frontend
{
    public function test__Incorrect_email()
    {
        $query_string = '/api/v1/ru/questions/12/subscribe.json?email=' . urlencode('test_mail.ru') . '&no_email=1';

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
