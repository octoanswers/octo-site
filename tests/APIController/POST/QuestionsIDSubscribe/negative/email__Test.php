<?php

namespace Tests\APIController\POST\QuestionsIDSubscribe;

class email__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['questions', 'questions_subscriptions']];

    public function test__IncorrectEmail()
    {
        $uri = '/api/v1/ru/questions/12/subscribe.json';
        $post_data = ['email' => urlencode('test_mail.ru'), 'no_email' => 1];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "email" property "test_mail.ru" must be valid email',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
