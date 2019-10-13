<?php

class QuestionsID_PUT_APIController__ru__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'revisions', 'activities'], 'users' => ['users']];

    public function testFullParams()
    {
        $queryString = '/api/v1/ru/questions/12.json?question_title=' . urlencode('Где мой новый ответ?');

        $request = $this->createRequest('PUT', $queryString);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'id'          => 12,
            'title'       => 'Где мой новый ответ?',
            'url'         => 'https://answeropedia.org/ru/%D0%93%D0%B4%D0%B5_%D0%BC%D0%BE%D0%B9_%D0%BD%D0%BE%D0%B2%D1%8B%D0%B9_%D0%BE%D1%82%D0%B2%D0%B5%D1%82',
            'is_redirect' => false,
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
