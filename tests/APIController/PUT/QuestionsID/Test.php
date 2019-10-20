<?php

namespace Tests\APIController\PUT\QuestionsID;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru'    => ['questions', 'revisions', 'activities'],
        'users' => ['users'],
    ];

    public function testFullParams()
    {
        $uri = '/api/v1/ru/questions/12.json';
        $form_data = [
            'question_title' => 'Где мой новый ответ?',
        ];

        $request = $this->createRequest('PUT', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'id'          => 12,
            'title'       => 'Где мой новый ответ?',
            'url'         => 'https://answeropedia.org/ru/%D0%93%D0%B4%D0%B5_%D0%BC%D0%BE%D0%B9_%D0%BD%D0%BE%D0%B2%D1%8B%D0%B9_%D0%BE%D1%82%D0%B2%D0%B5%D1%82',
            'is_redirect' => false,
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
