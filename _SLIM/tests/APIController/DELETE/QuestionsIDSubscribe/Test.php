<?php

namespace Tests\APIController\DELETE\QuestionsIDSubscribe;

class Test extends \Test\TestCase\Frontend
{
    public function test__Base_subscription()
    {
        $uri = '/api/v1/ru/questions/12/subscribe.json?email=' . urlencode('test@mail.ru') . '&no_email=1';

        $request = $this->createRequest('DELETE', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'API not realized',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
