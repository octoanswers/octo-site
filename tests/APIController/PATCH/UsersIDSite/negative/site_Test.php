<?php

class UsersIDSite_PATCH_APIController__site__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_IncorrectURL()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e'.'&'.'site='.urlencode('xxx');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/site.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'User "site" property "xxx" must be a URL',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_SiteNotSet()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e'.'&'.'foo_site='.urlencode('https://answeropedia.org');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/site.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'User "site" property null must be a string',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
