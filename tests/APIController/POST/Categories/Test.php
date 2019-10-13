<?php

class APIController_POST_Categories__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = [
        'ru'    => ['questions', 'categories', 'activities', 'er_categories_questions'],
        'users' => ['users'],
    ];

    public function test__Post_one_category()
    {
        $uri = '/api/v1/ru/categories.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e', 'categories' => 'Apple'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
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

    public function test__Post_multiple_categories()
    {
        $uri = '/api/v1/ru/categories.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e', 'categories' => 'Apple,Косметика'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
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
        $uri = '/api/v1/ru/categories.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e', 'categories' => ''];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Categories param not set',
        ];

        $this->assertEquals($expected_response, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Incorrect_API_key()
    {
        $uri = '/api/v1/ru/categories.json';
        $post_data = ['api_key' => 'XXX1ebdbec3d4e396043c96b6ab44a6e', 'categories' => 'Hello'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 1,
            'error_message' => 'Incorrect API-key',
        ];

        $this->assertEquals($expected_response, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
