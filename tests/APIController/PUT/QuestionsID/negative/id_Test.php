<?php

class QuestionsID_PUT_APIController__negative__id__Test extends \Test\TestCase\Frontend
{
    public function testQuestionIDEqualZero()
    {
        $queryString = '/api/v1/ru/questions/0.json?lang=en&question_title=' . urlencode('Where is my answers for Q12?');

        $request = $this->createRequest('PUT', $queryString);
        $response = $this->request($request);
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
        $queryString = '/api/v1/ru/questions/-1.json?lang=en&question_title=' . urlencode('Where is my answers for Q12?');

        $request = $this->createRequest('PUT', $queryString);
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
