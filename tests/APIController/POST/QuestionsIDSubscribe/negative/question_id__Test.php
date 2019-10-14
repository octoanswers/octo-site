<?php

namespace Tests\APIController\POST\QuestionsIDSubscribe;

class question_id__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['questions', 'questions_subscriptions']];

    public function test__Question_not_exists()
    {
        $uri = '/api/v1/ru/questions/236/subscribe.json';
        $post_data = ['email' => urlencode('data@test.ru'), 'no_email' => 1];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 1,
            'error_message' => 'Question with ID "236" not exists',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Question_ID_equal_zero()
    {
        $uri = '/api/v1/ru/questions/0/subscribe.json';
        $post_data = ['email' => urlencode('test@mail.ru'), 'no_email' => 1];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Question id param 0 must be greater than or equal to 1',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Question_ID_below_zero()
    {
        $uri = '/api/v1/ru/questions/-1/subscribe.json';
        $post_data = ['email' => urlencode('test@mail.ru'), 'no_email' => 1];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Question id param -1 must be greater than or equal to 1',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
