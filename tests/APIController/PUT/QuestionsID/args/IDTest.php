<?php

namespace Tests\APIController\PUT\QuestionsID;

class IDTest extends \Test\TestCase\Frontend
{
	public function test__Question_ID_equal_zero()
	{
		$uri = '/api/v1/ru/questions/0.json';
		$form_data = [
			'question_title' => 'Where is my answers?',
		];

		$request = $this->createRequest('PUT', $uri);
		$request = $this->withFormData($request, $form_data);

		$response = $this->request($request);
		$response_body = (string) $response->getBody();

		$expected_response = [
			'error_code'    => 0,
			'error_message' => 'Question id param 0 must be greater than or equal to 1',
		];

		$this->assertSame(200, $response->getStatusCode());
		$this->assertEquals($expected_response, json_decode($response_body, true));
	}

	public function test__Question_ID_below_zero()
	{
		$uri = '/api/v1/ru/questions/-1.json';
		$form_data = [
			'question_title' => 'Where is my answers?',
		];

		$request = $this->createRequest('PUT', $uri);
		$request = $this->withFormData($request, $form_data);

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
