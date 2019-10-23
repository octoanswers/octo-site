<?php

namespace Tests\APIController\POST\Signup;

class UsernameTest extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Username_already_exists()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'kozel', 'email' => 'new@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User with username "kozel" is already registered',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Username_too_short()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'J', 'email' => 'new@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "username" property "J" must have a length between 3 and 64',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Username_too_long()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = [
            'username' => 'foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobar',
            'email'    => 'new@answeropedia.org',
            'password' => 'jd754fJGFD99'
        ];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "username" property "foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobar" must have a length between 3 and 64',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
