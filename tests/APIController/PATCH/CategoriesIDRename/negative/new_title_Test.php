<?php

class CategoriesIDRename_PATCH_APIController__negative_new_titleTest extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['categories', 'activities', 'redirects_categories'], 'users' => ['users']];

    public function test_Error_when_category_new_title_not_set()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&not_new_title='.urlencode('ab');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/categories/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Category title param "" must have a length between 2 and 127',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_Error_when_category_new_title_too_short()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('z');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/categories/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Category title param "z" must have a length between 2 and 127',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
