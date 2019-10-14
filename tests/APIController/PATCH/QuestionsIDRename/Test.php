<?php

namespace Tests\APIController\PATCH\QuestionsIDRename;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru'    => ['questions', 'activities', 'redirects_questions'],
        'users' => ['users'],
    ];

    public function test__Rename_with_save_redirect()
    {
        $uri = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Гек?') . '&save_redirect=true';

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'question' => [
                'id'        => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Как ты, мистер Гек?',
                'url'       => 'https://answeropedia.org/ru/%D0%9A%D0%B0%D0%BA_%D1%82%D1%8B%2C_%D0%BC%D0%B8%D1%81%D1%82%D0%B5%D1%80_%D0%93%D0%B5%D0%BA',
            ],
            'user' => [
                'id'   => 3,
                'name' => 'Иван Коршунов',
            ],
            'redirect' => [
                'from_id'  => 34,
                'to_title' => 'Как ты, мистер Гек?',
            ],
            'activities' => [
                [
                    'id'   => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id'   => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ],
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Rename_without_save_redirect()
    {
        $uri = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Как ты, мистер Гек?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'question' => [
                'id'        => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Как ты, мистер Гек?',
                'url'       => 'https://answeropedia.org/ru/%D0%9A%D0%B0%D0%BA_%D1%82%D1%8B%2C_%D0%BC%D0%B8%D1%81%D1%82%D0%B5%D1%80_%D0%93%D0%B5%D0%BA',
            ],
            'user' => [
                'id'   => 3,
                'name' => 'Иван Коршунов',
            ],
            'activities' => [
                [
                    'id'   => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id'   => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ],
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Change_char_case_without_redirect()
    {
        $uri = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Огонь уничтожает КРОВЬ?');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'question' => [
                'id'        => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Огонь уничтожает КРОВЬ?',
                'url'       => 'https://answeropedia.org/ru/%D0%9E%D0%B3%D0%BE%D0%BD%D1%8C_%D1%83%D0%BD%D0%B8%D1%87%D1%82%D0%BE%D0%B6%D0%B0%D0%B5%D1%82_%D0%9A%D0%A0%D0%9E%D0%92%D0%AC',
            ],
            'user' => [
                'id'   => 3,
                'name' => 'Иван Коршунов',
            ],
            'activities' => [
                [
                    'id'   => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id'   => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ],
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Change_char_case_with_redirect()
    {
        $uri = '/api/v1/ru/questions/12/rename.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title=' . urlencode('Огонь уничтожает КРОВЬ?') . '&save_redirect=true';

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'question' => [
                'id'        => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Огонь уничтожает КРОВЬ?',
                'url'       => 'https://answeropedia.org/ru/%D0%9E%D0%B3%D0%BE%D0%BD%D1%8C_%D1%83%D0%BD%D0%B8%D1%87%D1%82%D0%BE%D0%B6%D0%B0%D0%B5%D1%82_%D0%9A%D0%A0%D0%9E%D0%92%D0%AC',
            ],
            'user' => [
                'id'   => 3,
                'name' => 'Иван Коршунов',
            ],
            'activities' => [
                [
                    'id'   => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id'   => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ],
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
