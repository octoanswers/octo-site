<?php

class Topics_ID_Questions_PUT_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'topics', 'activities', 'er_topics_questions'], 'users' => ['users']];

    public function test__QuestionFollowed()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&new_topics='.urlencode('Медицина, Гинекология');
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/4/topics.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang' => 'ru',
            'user_id' => 3,
            'user_name' => 'Иван Коршунов',
            'question_id' => 4,
            'question_title' => 'Чем занимается гинеколог?',
            'old_topics' => [
                'Медицина'
            ],
            'new_topics' => [
                'Медицина', 'Гинекология'
            ]
        ];

        # Check API-response

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());

        # Check real data changes

        $question = (new Question_Query('ru'))->questionWithID(4);

        $this->assertEquals(4, $question->getID());
        $this->assertEquals(["Медицина","Гинекология"], $question->getTopics());
        $this->assertEquals('["Медицина","Гинекология"]', $question->getTopicsJSON());

    }

    public function test__TopicsParamNotSet()
    {
        $query_string = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e';
        $request = $this->__getTestRequest('PUT', '/api/v1/ru/questions/7/topics.json', $query_string, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code' => 0,
            'error_message' => 'Topics param not set'
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
