<?php

class QuestionsIDRename_PATCH_APIController__new_title__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['questions', 'activities', 'redirects_questions'], 'users' => ['users']];

    public function test_NewTitleNotSet_Error()
    {
        $query_string = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&not_new_title=' . urlencode('ab?');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Question title param "" must have a length between 3 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_NewTitleTooShort_Error()
    {
        $query_string = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('M?');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Question title param "M?" must have a length between 3 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
