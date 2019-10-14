<?php

namespace Tests\APIController\PATCH\CategoriesIDRename;

class ID__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['categories', 'activities', 'redirects_categories'], 'users' => ['users']];

    public function test_Error_when_category_ID_equal_zero()
    {
        $uri = '/api/v1/ru/categories/0/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Category id param 0 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }

    public function test_Error_when_category_ID_below_zero()
    {
        $uri = '/api/v1/ru/categories/-1/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Category id param -1 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }
}
