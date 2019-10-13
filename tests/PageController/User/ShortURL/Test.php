<?php

namespace Tests\PageController\User\ShortURL;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'er_users_follow_users'],
        'ru'    => ['questions', 'revisions', 'er_users_follow_users'],
        'users' => ['users'],
    ];

    public function test__EnPage()
    {
        $request = $this->createRequest('GET', '/en/user/4');
        $response = $this->request($request);

        $this->assertSame(301, $response->getStatusCode());
    }

    public function test__Check_short_RU_URL()
    {
        $request = $this->createRequest('GET', '/ru/user/4');
        $response = $this->request($request);

        $this->assertSame(301, $response->getStatusCode());
    }
}
