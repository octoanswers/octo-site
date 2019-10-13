<?php

class Signup_POST_APIController__negative__email__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Email_is_incorrect()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'ivanivanov', 'email' => 'foo_answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "email" property "foo_answeropedia.org" must be valid email',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Email_already_registered()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'ivanivanov', 'email' => 'admin@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 1,
            'error_message' => 'User with specific email is already registered',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
