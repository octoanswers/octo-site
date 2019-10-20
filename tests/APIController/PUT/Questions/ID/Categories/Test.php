<?php

namespace Tests\APIController\PUT\Questions\ID\Categories;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru' => ['questions', 'categories', 'activities', 'er_categories_questions'],
        'users' => ['users']
    ];

    public function test__Add_one_category()
    {
        $uri = '/api/v1/ru/questions/22/categories.json';
        $form_data = [
            'new_categories' => 'Медицина,Гинекология',
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
        ];

        $request = $this->createRequest('PUT', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
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

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());

        // Check real data changes

        $question = (new \Query\Question('ru'))->questionWithID(22);

        $this->assertEquals(22, $question->id);
        $this->assertEquals(2, $question->categoriesCount);
    }

    public function test__Categories_param_not_set()
    {
        $uri = '/api/v1/ru/questions/22/categories.json';
        $form_data = [
            'api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e',
        ];

        $request = $this->createRequest('PUT', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'Categories param not set',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
