<?php

namespace Tests\APIController\POST\Logout;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectLogout()
    {
        $uri = '/api/v1/ru/logout.json';
        $form_data = ['api_key' => '9447243e3e1706375d23b06bf6dd1271'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'message'         => 'User unlogged',
            'destination_url' => 'https://answeropedia.org/ru',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }
}
