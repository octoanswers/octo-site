<?php

class QuestionsIDRename_PATCH_APIController__new_title_Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'activities', 'redirects'], 'users' => ['users']];

    public function test_NewTitleNotSet_Error()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&not_new_title='.urlencode('ab?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Question title param "" must have a length between 3 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }

    public function test_NewTitleTooShort_Error()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('M?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Question title param "M?" must have a length between 3 and 255',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
