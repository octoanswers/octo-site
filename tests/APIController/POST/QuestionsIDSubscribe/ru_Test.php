<?php

class QuestionsIDSubscribe_POST_APIController__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'questions_subscriptions']];

    public function test__Base_subscription()
    {
        $uri = '/api/v1/ru/questions/17/subscribe.json';
        $post_data = ['email' => 'data@test.ru', 'no_email' => 1];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang'               => 'ru',
            'question_id'        => 17,
            'question_title'     => 'Кто владеет компаний Apple после смерти Стива Джобса?',
            'question_url'       => 'https://answeropedia.org/ru/%D0%9A%D1%82%D0%BE_%D0%B2%D0%BB%D0%B0%D0%B4%D0%B5%D0%B5%D1%82_%D0%BA%D0%BE%D0%BC%D0%BF%D0%B0%D0%BD%D0%B8%D0%B9_Apple_%D0%BF%D0%BE%D1%81%D0%BB%D0%B5_%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8_%D0%A1%D1%82%D0%B8%D0%B2%D0%B0_%D0%94%D0%B6%D0%BE%D0%B1%D1%81%D0%B0',
            'subscription_id'    => 5,
            'subscription_email' => 'data@test.ru',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Already_subscribed()
    {
        $uri = '/api/v1/ru/questions/7/subscribe.json';
        $post_data = ['email' => 'data@test.ru', 'no_email' => 1];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Email "data@test.ru" already subscribed to question with ID 7',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
