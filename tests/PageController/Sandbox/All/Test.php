<?php

namespace Tests\PageController\Sandbox\All;

class Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = [
        'en'    => ['questions', 'categories', 'revisions', 'redirects_questions'],
        'ru'    => ['questions', 'categories', 'revisions', 'redirects_questions'],
        'users' => ['users'],
    ];

    public function test__Show_EN_page()
    {
        $request = $this->createRequest('GET', '/en/sandbox/all');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Sandbox – Page 1 – Answeropedia', $response_body);
        $this->assertStringContainsString('What is main president daily function?', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/sandbox/all');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
