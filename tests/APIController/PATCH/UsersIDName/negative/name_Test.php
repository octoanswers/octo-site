<?php

class UsersIDName_PATCH_APIController__signature__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_SignatureNotSet()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e' . '&' . 'foo_name=' . urlencode('Sasha');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/name.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
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
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&name=' . urlencode('Fo');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/name.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "name" property "Fo" must have a length between 2 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
