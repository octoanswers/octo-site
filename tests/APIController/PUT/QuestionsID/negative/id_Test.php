<?php

class QuestionsID_PUT_APIController__negative__id__Test extends Abstract_Frontend_TestCase
{
    public function testQuestionIDEqualZero()
    {
        $queryString = 'lang=en&question_title=' . urlencode('Where is my answers for Q12?');
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/0.json', $queryString, true);

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

    public function testQuestionIDBelowZero()
    {
        $queryString = 'lang=en&question_title=' . urlencode('Where is my answers for Q12?');
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/-1.json', $queryString, true);

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
