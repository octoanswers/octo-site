<?php

namespace Tests\PageController\User\Show;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'er_users_follow_users'],
        'ru'    => ['questions', 'revisions', 'er_users_follow_users'],
        'users' => ['users'],
    ];

    public function test__Lang_from_URI()
    {
        $request = $this->createRequest('GET', '/en/kozel');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Виталий Козлов Wiki-answers on Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Lang_from_browser()
    {
        $request = $this->createRequest('GET', '/kozel');
        $response = $this->request($request);

        $this->assertSame(303, $response->getStatusCode());
    }
}
