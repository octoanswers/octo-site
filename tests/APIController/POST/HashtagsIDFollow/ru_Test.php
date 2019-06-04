<?php

class CategoriesIDFollow_POST_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['activities', 'categories', 'er_users_follow_categories'], 'users' => ['users']];

    public function test__CategoryFollowed()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/categories/4/follow.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang' => 'ru',
            'relation_id' => 12,
            'user_id' => 3,
            'user_name' => 'Иван Коршунов',
            'followed_category_id' => 4,
            'followed_category_title' => 'автомобили', // @TODO
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__CategoryAlreadyFollowed()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e';
        $request = $this->__getTestRequest('POST', '/api/v1/ru/categories/7/follow.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'User with ID "3" already followed category with ID "7"'
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
