<?php

class CategoriesIDFollow_POST_APIController__ru__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru'    => ['activities', 'categories', 'er_users_follow_categories'],
        'users' => ['users'],
    ];

    public function test__Category_followed()
    {
        $uri = '/api/v1/ru/categories/4/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang'                    => 'ru',
            'relation_id'             => 12,
            'user_id'                 => 3,
            'user_name'               => 'Иван Коршунов',
            'followed_category_id'    => 4,
            'followed_category_title' => 'Автомобили',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Category_already_followed()
    {
        $uri = '/api/v1/ru/categories/7/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User with ID "3" already followed category with ID "7"',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
