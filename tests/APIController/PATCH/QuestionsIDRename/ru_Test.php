<?php

class QuestionsIDRename_PATCH_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'activities', 'redirects'], 'users' => ['users']];

    public function test_RenameWithSaveRedirect_Ok()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('Как ты, мистер Гек?').'&save_redirect=true';
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'question' => [
                'id' => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Как ты, мистер Гек?',
                'url' => 'http://octoanswers.com/ru/Как_ты,_мистер_Гек',
            ],
            'user' => [
                'id' => 3,
                'name' => 'Иван Коршунов',
            ],
            'redirect' => [
                'from_id' => 34,
                'to_title' => 'Как ты, мистер Гек?',
            ],
            'activities' => [
                [
                    'id' => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id' => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ]
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_RenameWithoutSaveRedirect_Ok()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('Как ты, мистер Гек?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'question' => [
                'id' => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Как ты, мистер Гек?',
                'url' => 'http://octoanswers.com/ru/Как_ты,_мистер_Гек',
            ],
            'user' => [
                'id' => 3,
                'name' => 'Иван Коршунов',
            ],
            'activities' => [
                [
                    'id' => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id' => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ]
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__ChangeCharCase__WithoutRedirect()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('Огонь уничтожает КРОВЬ?');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'question' => [
                'id' => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Огонь уничтожает КРОВЬ?',
                'url' => 'http://octoanswers.com/ru/Огонь_уничтожает_КРОВЬ',
            ],
            'user' => [
                'id' => 3,
                'name' => 'Иван Коршунов',
            ],
            'activities' => [
                [
                    'id' => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id' => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ]
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__ChangeCharCase__WithRedirect()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_title='.urlencode('Огонь уничтожает КРОВЬ?').'&save_redirect=true';
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/questions/12/rename.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'question' => [
                'id' => 12,
                'old_title' => 'Огонь уничтожает кровь?',
                'new_title' => 'Огонь уничтожает КРОВЬ?',
                'url' => 'http://octoanswers.com/ru/Огонь_уничтожает_КРОВЬ',
            ],
            'user' => [
                'id' => 3,
                'name' => 'Иван Коршунов',
            ],
            'activities' => [
                [
                    'id' => 13,
                    'type' => 'U_RENAME_Q',
                ],
                [
                    'id' => 14,
                    'type' => 'Q_RENAMED_BY_U',
                ],
            ]
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
