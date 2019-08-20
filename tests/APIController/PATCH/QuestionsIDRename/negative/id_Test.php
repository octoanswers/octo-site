<?php

class QuestionsIDRename_PATCH_APIController__rename_id_Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'activities', 'redirects_questions'], 'users' => ['users']];

    public function test_QuestionIDEqualZero_Error()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('Как ты, мистер Хайдегер?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/0/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
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
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('Как ты, мистер Хайдегер?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/-1/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Question id param -1 must be greater than or equal to 1',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
