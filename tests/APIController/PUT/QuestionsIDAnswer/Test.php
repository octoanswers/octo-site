<?php

namespace Tests\APIController\PUT\QuestionsIDAnswer;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru' => ['questions', 'revisions', 'activities'],
        'users' => ['users']
    ];

    public function test__New_answer_with_full_params()
    {
        $query_URI = '/api/v1/ru/questions/15/answer.json?answer_text=' . urlencode('В Екатеринбурге.') . '&changes_comment=' . urlencode('Правка сделана в 09-28') . '&user_api_key=34b88c8f1ed16fdcc18d93667c886fcc';

        $request = $this->createRequest('PUT', $query_URI);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'question_id'        => 15,
            'question_title'     => 'Где я родился?',
            'question_url'       => 'https://answeropedia.org/ru/%D0%93%D0%B4%D0%B5_%D1%8F_%D1%80%D0%BE%D0%B4%D0%B8%D0%BB%D1%81%D1%8F',
            'answer_text'        => 'В Екатеринбурге.',
            'revision_id'        => 8,
            'revision_opcodes'   => 'd6i30:В Екатеринбурге.',
            'revision_base_text' => 'ЕКБ',
            'revision_comment'   => 'Правка сделана в 09-28',
            'user'               => [
                'id'   => 1,
                'name' => 'Александр Гомзяков',
            ],
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Replace_answer_with_full_params()
    {
        $queryString = '/api/v1/ru/questions/21/answer.json?answer_text=' . urlencode('Нет, птицы не делают игры.') . '&changes_comment=' . urlencode('Some fixes for Q15') . '&user_api_key=34b88c8f1ed16fdcc18d93667c886fcc';

        $request = $this->createRequest('PUT', $queryString);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'question_id'        => 21,
            'question_title'     => 'Как птицы делают видеоигры?',
            'question_url'       => 'https://answeropedia.org/ru/%D0%9A%D0%B0%D0%BA_%D0%BF%D1%82%D0%B8%D1%86%D1%8B_%D0%B4%D0%B5%D0%BB%D0%B0%D1%8E%D1%82_%D0%B2%D0%B8%D0%B4%D0%B5%D0%BE%D0%B8%D0%B3%D1%80%D1%8B',
            'answer_text'        => 'Нет, птицы не делают игры.',
            'revision_id'        => 8,
            'revision_opcodes'   => 'd34i8:Нет, c11i5:не c22',
            'revision_base_text' => 'Никто не знает как птицы делают игры.',
            'revision_comment'   => 'Some fixes for Q15',
            'user'               => [
                'id'   => 1,
                'name' => 'Александр Гомзяков',
            ],
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__New_answer_without_revision_comment()
    {
        $queryString = '/api/v1/ru/questions/15/answer.json?answer_text=' . urlencode('В Краснодаре.') . '&user_api_key=34b88c8f1ed16fdcc18d93667c886fcc';

        $request = $this->createRequest('PUT', $queryString);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'question_id'        => 15,
            'question_title'     => 'Где я родился?',
            'question_url'       => 'https://answeropedia.org/ru/%D0%93%D0%B4%D0%B5_%D1%8F_%D1%80%D0%BE%D0%B4%D0%B8%D0%BB%D1%81%D1%8F',
            'answer_text'        => 'В Краснодаре.',
            'revision_id'        => 8,
            'revision_opcodes'   => 'd6i24:В Краснодаре.',
            'revision_base_text' => 'ЕКБ',
            'revision_comment'   => null,
            'user'               => [
                'id'   => 1,
                'name' => 'Александр Гомзяков',
            ],
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
