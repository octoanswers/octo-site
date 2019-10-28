<?php

namespace Tests\APIController\PATCH\UsersIDSignature;

class SignatureTest extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test__Signature_not_set()
    {
        $uri = '/api/v1/ru/users/3/signature.json';
        $post_data = [
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'foo_signature' => 'Enterpreneur, writer.',
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "signature" property null must be a string',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }

    public function test__Signature_too_short()
    {
        $uri = '/api/v1/ru/users/3/signature.json';
        $post_data = [
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'signature' => 'Fo',
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "signature" property "Fo" must have a length between 3 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }
}
