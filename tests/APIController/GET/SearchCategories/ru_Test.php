<?php

class APIController_GET_SearchCategories__ru__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__One_char_query()
    {
        $uri = '/api/v1/ru/search/categories.json?query=' . urlencode('а');

        $request = $this->createRequest('GET', $uri);
        $response = $this->request($request);
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

    public function test__Two_char_query()
    {
        $uri = '/api/v1/ru/search/categories.json?query=' . urlencode('авто');

        $request = $this->createRequest('GET', $uri);
        $response = $this->request($request);
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

    public function test__Search_empty_query()
    {
        $uri = '/api/v1/ru/search/categories.json?query=' . urlencode('');

        $request = $this->createRequest('GET', $uri);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
