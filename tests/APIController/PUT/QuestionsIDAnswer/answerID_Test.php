<?php

class QuestionsIDAnswer_PUT_APIController__answerID_Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function testQuestionIDEqualZero()
    {
        $queryString = '/api/v1/ru/questions/0/answer.json?answer_text=' . urlencode('In Ekaterinburg.') . 'revision_comment=' . urlencode('Some fixes for Q15') . '&user_api_key=34b88c8f1ed16fdcc18d93667c886fcc';

        $request = $this->createRequest('PUT', $queryString);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Answer id param 0 must be greater than or equal to 1',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_questionIDBelowZero()
    {
        $queryString = '/api/v1/ru/questions/-1/answer.json?answer_text=' . urlencode('In Ekaterinburg.') . 'revision_comment=' . urlencode('Some fixes for Q15') . '&user_api_key=34b88c8f1ed16fdcc18d93667c886fcc';

        $request = $this->createRequest('PUT', $queryString);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Answer id param -1 must be greater than or equal to 1',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
