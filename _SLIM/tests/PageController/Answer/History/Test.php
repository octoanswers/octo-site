<?php

namespace Tests\PageController\Answer\History;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions'],
        'ru'    => ['questions', 'revisions'],
        'users' => ['users'],
    ];

    public function test__Show_EN_page()
    {
        $request = $this->createRequest('GET', '/en/answer/4/history');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Answer history: How to cry? – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/answer/4/history');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
