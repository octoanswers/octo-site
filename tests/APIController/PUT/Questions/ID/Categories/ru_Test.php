<?php

class Categories_ID_Questions_PUT_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'categories', 'activities', 'er_categories_questions'], 'users' => ['users']];

    public function test_Add_one_category()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_categories=' . urlencode('Медицина,Гинекология');
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/22/categories.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang'      => 'ru',
            'user_id'   => 3,
            'user_name' => 'Иван Коршунов',
            'question'  => [
                'id'    => 22,
                'title' => 'Чем модульное тестирование отличается от интеграционного?',
                'url'   => 'https://answeropedia.org/ru/%D0%A7%D0%B5%D0%BC_%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8C%D0%BD%D0%BE%D0%B5_%D1%82%D0%B5%D1%81%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5_%D0%BE%D1%82%D0%BB%D0%B8%D1%87%D0%B0%D0%B5%D1%82%D1%81%D1%8F_%D0%BE%D1%82_%D0%B8%D0%BD%D1%82%D0%B5%D0%B3%D1%80%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D0%BE%D0%B3%D0%BE',
            ],
            'old_categories' => [
                'Косметика',
                'Птицы',
            ],
            'new_categories' => [
                'Медицина',
                'Гинекология',
            ],
        ];

        // Check API-response

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());

        // Check real data changes

        $question = (new Question_Query('ru'))->questionWithID(22);

        $this->assertEquals(22, $question->id);
        $this->assertEquals(2, $question->categoriesCount);
    }

    public function test__CategoriesParamNotSet()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e';
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/7/categories.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'Categories param not set',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
