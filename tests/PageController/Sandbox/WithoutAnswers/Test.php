<?php

namespace Tests\PageController\Sandbox\WithoutAnswers;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en' => ['questions', 'categories', 'revisions'],
        'ru' => ['questions', 'categories', 'revisions'], 'users' => ['users'],
    ];

    public function test__Show_EN_page()
    {
        $request = $this->createRequest('GET', '/en/sandbox/without-answers');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Questions without answers – Page 1 – Answeropedia', $response_body);
        $this->assertStringContainsString('Do you like iPhone 6?', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Check_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/sandbox/without-answers');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
