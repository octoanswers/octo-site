<?php

class UsersIDSignature_PATCH_APIController__id__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_UserIDEqualZero_Error()
    {
        $query_string = '/api/v1/ru/users/0/signature.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&signature=' . urlencode('Enterpreneur, writer.');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Incorrect user id or API-key',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_UserIDBelowZero_Error()
    {
        $query_string = '/api/v1/ru/users/-1/signature.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&signature=' . urlencode('Enterpreneur, writer.');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Incorrect user id or API-key',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
