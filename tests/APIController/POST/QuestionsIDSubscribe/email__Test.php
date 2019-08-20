<?php

class QuestionsIDSubscribe_POST_APIController__email__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'questions_subscriptions']];

    public function test__IncorrectEmail()
    {
        $query_string = 'email='.urlencode('test_mail.ru').'&no_email=1';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/questions/12/subscribe.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "email" property "test_mail.ru" must be valid email',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
