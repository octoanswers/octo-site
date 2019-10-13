<?php

namespace Tests\PageController\Questions\Newest;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en'    => ['questions', 'categories', 'revisions', 'er_categories_questions'],
        'ru'    => ['questions', 'categories', 'revisions', 'er_categories_questions'],
        'users' => ['users'],
    ];

    public function test__Show_questions_page()
    {
        $request = $this->createRequest('GET', '/en/questions/newest');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Newest questions – Page 1 – Answeropedia', $response_body);
        $this->assertStringContainsString('What is main president daily function?', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__That_RU_page_is_exists()
    {
        $request = $this->createRequest('GET', '/ru/questions/newest');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
