<?php

namespace Tests\APIController\PATCH\UsersIDSite;

class SiteTest extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test__Incorrect_URL()
    {
        $uri = '/api/v1/ru/users/3/site.json';
        $post_data = [
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'site'    => 'xxx',
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "site" property "xxx" must be a URL',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }

    public function test__Site_not_set()
    {
        $uri = '/api/v1/ru/users/3/site.json';
        $post_data = [
            'api_key'  => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'foo_site' => 'https://answeropedia.org',
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "site" property null must be a string',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }

    public function test__URL_without_protocol()
    {
        $uri = '/api/v1/ru/users/3/site.json';
        $post_data = [
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'site'    => 'example37.com',
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "site" property "example37.com" must be a URL',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__URL_with_WWW()
    {
        $uri = '/api/v1/ru/users/3/site.json';
        $post_data = [
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'site'    => 'www.example32.com',
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User "site" property "www.example32.com" must be a URL',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
