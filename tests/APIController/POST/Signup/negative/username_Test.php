<?php

class Signup_POST_APIController__negative__username__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Username_already_exists()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'kozel', 'email' => 'new@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User with username "kozel" is already registered',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Username_too_short()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'J', 'email' => 'new@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "username" property "J" must have a length between 3 and 64',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
