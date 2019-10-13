<?php

class Signup_POST_APIController__negative__password__Test extends \Tests\Frontend\TestCase
{
    public function test__Password_too_short()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'kozel', 'email' => 'new@answeropedia.org', 'password' => '1234'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "password" property "1234" must have a length between 6 and 32',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
