<?php

namespace Tests\APIController\POST\UsersIDFollow;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities', 'er_users_follow_users'], 'users' => ['users']];

    public function test__Base_follow()
    {
        $uri = '/api/v1/ru/users/4/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'relation_id'        => 8,
            'user_id'            => 3,
            'user_name'          => 'Иван Коршунов',
            'followed_user_id'   => 4,
            'followed_user_name' => 'Александр Пушкин',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__User_already_followed()
    {
        $uri = '/api/v1/ru/users/7/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User with ID "7" already followed by user with ID "3"',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
