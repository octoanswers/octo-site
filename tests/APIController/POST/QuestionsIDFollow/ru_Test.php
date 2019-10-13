<?php

class QuestionsIDFollow_POST_APIController__ru__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['ru' => ['questions', 'activities', 'er_users_follow_questions'], 'users' => ['users']];

    public function test__QuestionFollowed()
    {
        $uri = '/api/v1/ru/questions/4/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang'                    => 'ru',
            'relation_id'             => 9,
            'user_id'                 => 3,
            'user_name'               => 'Иван Коршунов',
            'followed_question_id'    => 4,
            'followed_question_title' => 'Чем занимается гинеколог?',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Question_already_followed()
    {
        $uri = '/api/v1/ru/questions/7/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User with ID "3" already followed question with ID "7"',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
