<?php

namespace Tests\PageController\Users\Newest;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Get_EN_page()
    {
        $request = $this->createRequest('GET', '/en/users/newest');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('New users from around the world – Page 0 – Answeropedia', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Check_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/users/newest');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
