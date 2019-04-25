<?php

class Hashtags_ID_Questions_PUT_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'hashtags', 'activities', 'er_hashtags_questions'], 'users' => ['users']];

    public function test__QuestionFollowed()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_hashtags='.urlencode('Медицина, Гинекология');
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/4/hashtags.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang' => 'ru',
            'user_id' => 3,
            'user_name' => 'Иван Коршунов',
            'question' => [
                'id' => 4,
                'title' => 'Чем занимается гинеколог?',
                'url' => 'https://answeropedia.org/ru/%D0%A7%D0%B5%D0%BC_%D0%B7%D0%B0%D0%BD%D0%B8%D0%BC%D0%B0%D0%B5%D1%82%D1%81%D1%8F_%D0%B3%D0%B8%D0%BD%D0%B5%D0%BA%D0%BE%D0%BB%D0%BE%D0%B3'
            ],
            'old_hashtags' => [
                'Медицина'
            ],
            'new_hashtags' => [
                'Медицина', 'Гинекология'
            ]
        ];

        # Check API-response

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());

        # Check real data changes

        $question = (new Question_Query('ru'))->questionWithID(4);

        $this->assertEquals(4, $question->id);
        $this->assertEquals(["Медицина","Гинекология"], $question->getHashtags());
        $this->assertEquals('["Медицина","Гинекология"]', $question->getHashtagsJSON());
    }

    public function test__HashtagsParamNotSet()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e';
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/7/hashtags.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Hashtags param not set'
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
