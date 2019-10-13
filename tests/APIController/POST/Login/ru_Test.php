<?php

class Login_POST_APIController__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Correct_login()
    {
        $uri = '/api/v1/ru/login.json';
        $form_data = ['email' => 'admin@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $form_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang'            => 'ru',
            'id'              => 3,
            'email'           => 'admin@answeropedia.org',
            'name'            => 'Иван Коршунов',
            'api_key'         => '7d21ebdbec3d4e396043c96b6ab44a6e',
            'created_at'      => '2016-03-19 06:47:41',
            'url'             => 'https://answeropedia.org/ru/@ivan',
            'destination_url' => 'https://answeropedia.org/ru',
        ];

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
    }
}
