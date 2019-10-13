<?php

namespace Tests\PageController\Main\Unlogged;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'categories', 'er_categories_questions'],
        'ru'    => ['questions', 'revisions', 'categories', 'er_categories_questions'],
        'users' => ['users'],
    ];

    public function test__Show_main_page()
    {
        $request = $this->createRequest('GET', '/en');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Answeropedia – Ask a question and get one complete answer', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Check_that_RU_page_is_exists()
    {
        $request = $this->createRequest('GET', '/ru');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
