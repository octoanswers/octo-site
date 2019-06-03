<?php

class APIController_GET_SearchCategories_ru_Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_One_char_query()
    {
        $queryString = 'query='.urlencode('а');
        $request = $this->__getTestRequest('GET', '/api/v1/ru/search/categories.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();
        
        $expectedResponse = [
            0 => 'русскаялитература',
            1 => 'отделочныематериалы',
            2 => 'автомобили',
            3 => 'москва',
            4 => 'автоспорт',
            5 => 'косметика',
            6 => 'парфюмерия',
            7 => 'каша',
            8 => 'кашемир',
            9 => 'живаяприрода'
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Two_char_query()
    {
        $queryString = 'query='.urlencode('авто');
        $request = $this->__getTestRequest('GET', '/api/v1/ru/search/categories.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();
        
        $expectedResponse = [
            'автомобили',
            'автоспорт'
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Search_empty_query()
    {
        $queryString = 'query='.urlencode('');
        $request = $this->__getTestRequest('GET', '/api/v1/ru/search/categories.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();
        
        $expectedResponse = [];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
