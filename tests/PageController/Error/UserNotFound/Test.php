<?php

namespace Tests\PageController\Error\UserNotFound;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'users' => ['users'],
    ];

    public function test__Unexists_username()
    {
        $request = $this->createRequest('GET', '/en/@unexistsusername');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('User not found – unexistsusername – Answeropedia', $response_body);
        $this->assertSame(404, $response->getStatusCode());
    }
}
