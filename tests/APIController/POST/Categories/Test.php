<?php

class APIController_POST_Categories__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'categories', 'activities', 'er_categories_questions'], 'users' => ['users']];

    public function test_Post_one_category()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&categories=' . urlencode('Apple');
        $request = $this->__getTestRequest('POST', '/api/v1/ru/categories.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expected_response = [
            'lang' => 'ru',
            'user' => [
                'id'   => 3,
                'name' => 'Иван Коршунов',
            ],
            'categories' => [
                'created' => [
                    0 => 'Apple',
                ],
                'exists' => [],
            ],

        ];

        // Check API-response

        $this->assertEquals($expected_response, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Post_multiple_categories()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&categories=' . urlencode('Apple,Косметика');
        $request = $this->__getTestRequest('POST', '/api/v1/ru/categories.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expected_response = [
            'lang' => 'ru',
            'user' => [
                'id'   => 3,
                'name' => 'Иван Коршунов',
            ],
            'categories' => [
                'created' => [
                    'Apple',
                ],
                'exists' => [
                    'Косметика',
                ],
            ],

        ];

        // Check API-response

        $this->assertEquals($expected_response, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Categories_not_set()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&categories=' . urlencode('');
        $request = $this->__getTestRequest('POST', '/api/v1/ru/categories.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Categories param not set',
        ];

        $this->assertEquals($expected_response, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Incorrect_API_key()
    {
        $query_string = 'api_key=XXX1ebdbec3d4e396043c96b6ab44a6e&categories=' . urlencode('Hello');
        $request = $this->__getTestRequest('POST', '/api/v1/ru/categories.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 1,
            'error_message' => 'Incorrect API-key',
        ];

        $this->assertEquals($expected_response, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
