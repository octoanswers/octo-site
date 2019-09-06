<?php

class CategoriesIDRename_PATCH_APIController__negative__ID__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['categories', 'activities', 'redirects_categories'], 'users' => ['users']];

    public function test_Error_when_category_ID_equal_zero()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/categories/0/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Category id param 0 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_Error_when_category_ID_below_zero()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/categories/-1/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Category id param -1 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
