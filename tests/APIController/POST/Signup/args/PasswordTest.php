<?php

namespace Tests\APIController\POST\Signup;

class PasswordTest extends \Test\TestCase\Frontend
{
    public function test__Password_too_short()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'kozel', 'email' => 'new@answeropedia.org', 'password' => '1234'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "password" property "1234" must have a length between 6 and 32',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
