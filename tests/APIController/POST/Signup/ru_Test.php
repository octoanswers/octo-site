<?php

class Signup_POST_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectSignup()
    {
        $request = $this->__getTestRequest('POST', '/api/v1/ru/signup.json', 'username=jasonborn&email=new@octoanswers.com&password=jd754fJGFD99', true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'id' => 16,
            'username' => 'jasonborn',
            'email' => 'new@octoanswers.com',
            'url' => 'http://octoanswers.com/ru/+jasonborn',
            'destination_url' => 'http://octoanswers.com/ru'
        ];

        $responseArray = json_decode($responseBody, true);
        unset($responseArray['created_at']);
        unset($responseArray['password_hash']);
        unset($responseArray['api_key']);

        $this->assertEquals($expectedResponse, $responseArray);
        $this->assertSame(200, $response->getStatusCode());
    }
}
