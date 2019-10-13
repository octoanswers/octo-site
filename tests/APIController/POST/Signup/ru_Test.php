<?php

class Signup_POST_APIController__ru__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectSignup()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'jasonborn', 'email' => 'new@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'id'              => 16,
            'username'        => 'jasonborn',
            'email'           => 'new@answeropedia.org',
            'url'             => 'https://answeropedia.org/ru/@jasonborn',
            'destination_url' => 'https://answeropedia.org/ru',
            'avatar_100'      => 'Avatar file "16_100.png" copied',
            'avatar_200'      => 'Avatar file "16_200.png" copied',
            'avatar_400'      => 'Avatar file "16_400.png" copied',
        ];

        $responseArray = json_decode($responseBody, true);
        unset($responseArray['created_at']);
        unset($responseArray['password_hash']);
        unset($responseArray['api_key']);

        $this->assertEquals($expectedResponse, $responseArray);
        $this->assertSame(200, $response->getStatusCode());
    }
}
