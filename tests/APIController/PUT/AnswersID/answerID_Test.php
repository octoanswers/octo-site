<?php

class AnswersID_PUT_APIController__answerID_Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testQuestionIDEqualZero()
    {
        $queryString = 'answer_text='.urlencode('In Ekaterinburg.').'revision_comment='.urlencode('Some fixes for Q15').'&user_api_key=34b88c8f1ed16fdcc18d93667c886fcc';
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/answers/0.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Answer id param 0 must be greater than or equal to 1',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_questionIDBelowZero()
    {
        $queryString = 'answer_text='.urlencode('In Ekaterinburg.').'revision_comment='.urlencode('Some fixes for Q15').'&user_api_key=34b88c8f1ed16fdcc18d93667c886fcc';
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/answers/-1.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Answer id param -1 must be greater than or equal to 1',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
