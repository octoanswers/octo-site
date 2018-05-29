<?php

class UsersIDSite_PATCH_APIController__abnormal__site__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test__URLWithoutProtocol()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&site='.urlencode('example37.com');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/site.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'User "site" property "example37.com" must be an URL',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__URLWithWWW()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&site='.urlencode('www.example32.com');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/site.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'User "site" property "www.example32.com" must be an URL',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
