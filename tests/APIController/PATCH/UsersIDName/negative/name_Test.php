<?php

class UsersIDName_PATCH_APIController__name__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_SignatureNotSet()
    {
        $query_string = '/api/v1/ru/users/3/name.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e' . '&' . 'foo_name=' . urlencode('Sasha');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "name" property null must be a string',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_SignatureTooShort()
    {
        $query_string = '/api/v1/ru/users/3/name.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&name=' . urlencode('Fo');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "name" property "Fo" must have a length between 2 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
