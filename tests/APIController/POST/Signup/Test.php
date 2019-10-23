<?php

namespace Tests\APIController\POST\Signup;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Correct_signup()
    {
        $uri = '/api/v1/ru/signup.json';
        $post_data = ['username' => 'jasonborn', 'email' => 'new@answeropedia.org', 'password' => 'jd754fJGFD99'];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'id'              => 16,
            'username'        => 'jasonborn',
            'email'           => 'new@answeropedia.org',
            'url'             => 'https://answeropedia.org/ru/jasonborn',
            'destination_url' => 'https://answeropedia.org/ru',
            'avatar_100'      => 'Avatar file "16_100.png" copied',
            'avatar_200'      => 'Avatar file "16_200.png" copied',
            'avatar_400'      => 'Avatar file "16_400.png" copied',
        ];

        $responseArray = json_decode($response_body, true);
        unset($responseArray['created_at']);
        unset($responseArray['password_hash']);
        unset($responseArray['api_key']);

        $this->assertEquals($expected_response, $responseArray);
        $this->assertSame(200, $response->getStatusCode());
    }

    // @TODO
    // Username_with_uppercase
}
