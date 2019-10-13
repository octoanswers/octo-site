<?php

class QuestionsIDSubscribe_POST_APIController__negative__email__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['questions', 'questions_subscriptions']];

    public function test__IncorrectEmail()
    {
        $uri = '/api/v1/ru/questions/12/subscribe.json';
        $post_data = ['email' => urlencode('test_mail.ru'), 'no_email' => 1];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "email" property "test_mail.ru" must be valid email',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
