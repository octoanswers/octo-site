<?php

namespace Tests\APIController\PATCH\QuestionsIDRename;

class NewTitleTest extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru' => ['questions', 'activities', 'redirects_questions'],
        'users' => ['users']
    ];

    public function test__New_title_not_set()
    {
        $uri = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&not_new_title=' . urlencode('ab?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Question title param "" must have a length between 3 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }

    public function test__New_title_too_short()
    {
        $uri = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('M?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Question title param "M?" must have a length between 3 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expected_response, json_decode($response_body, true));
    }
}
