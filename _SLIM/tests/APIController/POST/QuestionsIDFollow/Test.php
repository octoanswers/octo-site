<?php

namespace Tests\APIController\POST\QuestionsIDFollow;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['questions', 'activities', 'er_users_follow_questions'], 'users' => ['users']];

    public function test__QuestionFollowed()
    {
        $uri = '/api/v1/ru/questions/4/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'lang'                    => 'ru',
            'relation_id'             => 9,
            'user_id'                 => 3,
            'user_name'               => 'Иван Коршунов',
            'followed_question_id'    => 4,
            'followed_question_title' => 'Чем занимается гинеколог?',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Question_already_followed()
    {
        $uri = '/api/v1/ru/questions/7/follow.json';
        $post_data = ['api_key' => '7d21ebdbec3d4e396043c96b6ab44a6e'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'error_code'    => 0,
            'error_message' => 'User with ID "3" already followed question with ID "7"',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
