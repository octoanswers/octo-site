<?php

namespace Tests\APIController\PATCH\QuestionsIDRename;

class IDTest extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru'    => ['questions', 'activities', 'redirects_questions'],
        'users' => ['users'],
    ];

    public function test__Question_ID_equal_zero()
    {
        $uri = '/api/v1/ru/questions/0/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Question id param 0 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }

    public function test__Question_ID_below_zero()
    {
        $uri = '/api/v1/ru/questions/-1/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Question id param -1 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }
}
