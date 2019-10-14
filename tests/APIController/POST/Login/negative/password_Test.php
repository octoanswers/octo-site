<?php

namespace Tests\APIController\POST\Login;

class password__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Password_too_short()
    {
        $uri = '/api/v1/ru/login.json';
        $form_data = ['email' => 'admin@answeropedia.org', 'password' => 'foo'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "password" property "foo" must have a length between 6 and 32',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }

    public function test__Password_is_incorrect()
    {
        $uri = '/api/v1/ru/login.json';
        $form_data = ['email' => 'admin@answeropedia.org', 'password' => '123456789'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 1,
            'error_message' => 'WRONG_PASSWORD',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }
}
