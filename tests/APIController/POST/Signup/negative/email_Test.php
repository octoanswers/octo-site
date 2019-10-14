<?php

namespace Tests\APIController\POST\Signup;

class email__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Email_is_incorrect()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'ivanivanov', 'email' => 'foo_answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "email" property "foo_answeropedia.org" must be valid email',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Email_already_registered()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'ivanivanov', 'email' => 'admin@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 1,
            'error_message' => 'User with specific email is already registered',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
