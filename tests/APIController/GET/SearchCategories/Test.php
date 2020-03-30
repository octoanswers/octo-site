<?php

namespace Tests\APIController\GET\SearchCategories;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__One_char_query()
    {
        $uri = '/api/v1/ru/search/categories.json?query='.urlencode('а');

        $request = $this->createRequest('GET', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_responseZeroItem = [
            'id'             => 1,
            'display_string' => 'Русская литература – 1',
            'title'          => 'Русская литература',
        ];

        $actualResponse = json_decode($response_body, true);

        $this->assertEquals($expected_responseZeroItem, $actualResponse[0]);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Two_char_query()
    {
        $uri = '/api/v1/ru/search/categories.json?query='.urlencode('авто');

        $request = $this->createRequest('GET', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
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

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Search_empty_query()
    {
        $uri = '/api/v1/ru/search/categories.json?query='.urlencode('');

        $request = $this->createRequest('GET', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
