<?php

class APIController_GET_SearchCategories_ru_Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_One_char_query()
    {
        $queryString = 'query=' . urlencode('а');
        $request = $this->__getTestRequest('GET', '/api/v1/ru/search/categories.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponseZeroItem = [
            'id'             => 1,
            'display_string' => 'Русская литература – 1',
            'title'          => 'Русская литература',
        ];

        $actualResponse = json_decode($responseBody, true);

        $this->assertEquals($expectedResponseZeroItem, $actualResponse[0]);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Two_char_query()
    {
        $queryString = 'query=' . urlencode('авто');
        $request = $this->__getTestRequest('GET', '/api/v1/ru/search/categories.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            [
                'id'             => 4,
                'display_string' => 'Автомобили – 4',
                'title'          => 'Автомобили',
            ],
            [
                'id'             => 6,
                'display_string' => 'Автоспорт – 6',
                'title'          => 'Автоспорт',
            ],
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Search_empty_query()
    {
        $queryString = 'query=' . urlencode('');
        $request = $this->__getTestRequest('GET', '/api/v1/ru/search/categories.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
