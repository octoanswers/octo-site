<?php

class UsersIDFollow_DELETE_APIController__ru__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = [
        'ru' => ['er_users_follow_users'],
        'users' => ['users']
    ];

    public function test__Base_unfollow()
    {
        $query_string = '/api/v1/ru/users/7/follow.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e';

        $request = $this->createRequest('DELETE', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'user_id'            => 3,
            'user_name'          => 'Иван Коршунов',
            'followed_user_id'   => 7,
            'followed_user_name' => 'Павел Перепелов',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Not_followed()
    {
        $query_string = '/api/v1/ru/users/4/follow.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e';

        $request = $this->createRequest('DELETE', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User with ID "4" not followed by user with ID "3"',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
