<?php

namespace Tests\APIController\PATCH\CategoriesIDRename;

class IDTest extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru'    => ['categories', 'activities', 'redirects_categories'],
        'users' => ['users'],
    ];

    public function test__Error_when_category_ID_equal_zero()
    {
        $uri = '/api/v1/ru/categories/0/rename.json';
        $post_data = [
            'api_key'           => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'not_new_title'     => 'Work',
            'save_redirect'     => 1,
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

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
        $uri = '/api/v1/ru/categories/-1/rename.json';
        $post_data = [
            'api_key'           => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'not_new_title'     => 'Work',
        ];

        $request = $this->createRequest('PATCH', $uri);
        $request = $this->withFormData($request, $post_data);

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
