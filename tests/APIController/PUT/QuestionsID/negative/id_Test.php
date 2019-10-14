<?php

namespace Tests\APIController\PUT\QuestionsID;

class id__Test extends \Test\TestCase\Frontend
{
  public function testQuestionIDEqualZero()
  {
    $queryString = '/api/v1/ru/questions/0.json?lang=en&question_title=' . urlencode('Where is my answers for Q12?');

    $request = $this->createRequest('PUT', $queryString);
    $response = $this->request($request);
    $response_body = (string) $response->getBody();

    $expected_response = [
      'error_code'    => 0,
      'error_message' => 'Question id param 0 must be greater than or equal to 1',
    ];

    $this->assertSame(200, $response->getStatusCode());
    $this->assertEquals($expected_response, json_decode($response_body, true));
  }

  public function testQuestionIDBelowZero()
  {
    $queryString = '/api/v1/ru/questions/-1.json?lang=en&question_title=' . urlencode('Where is my answers for Q12?');

    $request = $this->createRequest('PUT', $queryString);
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
