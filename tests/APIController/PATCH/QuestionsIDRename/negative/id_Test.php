<?php

class QuestionsIDRename_PATCH_APIController__rename__id__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['questions', 'activities', 'redirects_questions'], 'users' => ['users']];

    public function test_QuestionIDEqualZero_Error()
    {
        $query_string = '/api/v1/ru/questions/0/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Question id param 0 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_QuestionIDBelowZero_Error()
    {
        $query_string = '/api/v1/ru/questions/-1/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Хайдегер?');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Question id param -1 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
