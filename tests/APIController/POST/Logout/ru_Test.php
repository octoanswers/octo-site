<?php

class Logout_POST_APIController__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectLogout()
    {
        $uri = '/api/v1/ru/logout.json';
        $form_data = ['api_key' => '9447243e3e1706375d23b06bf6dd1271'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'message'         => 'User unlogged',
            'destination_url' => 'https://answeropedia.org/ru',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
