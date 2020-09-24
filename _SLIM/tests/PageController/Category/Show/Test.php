<?php

namespace Test\PageController\Category\Show;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en' => ['questions', 'categories', 'revisions', 'er_categories_questions', 'er_users_follow_categories'],
        'ru' => ['questions', 'categories', 'revisions', 'er_categories_questions', 'er_users_follow_categories'],
    ];

    public function test__Show_EN_page()
    {
        $request = $this->createRequest('GET', '/en/category/Cashmere');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Category: Cashmere – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/category/Птицы');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
