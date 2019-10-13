<?php

class CategoriesIDRename_PATCH_APIController__negative__new_title__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['ru' => ['categories', 'activities', 'redirects_categories'], 'users' => ['users']];

    public function test_Error_when_category_new_title_not_set()
    {
        $query_string = '/api/v1/ru/categories/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&not_new_title=' . urlencode('ab');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Category title param "" must have a length between 2 and 127',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_Error_when_category_new_title_too_short()
    {
        $query_string = '/api/v1/ru/categories/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('z');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Category title param "z" must have a length between 2 and 127',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
