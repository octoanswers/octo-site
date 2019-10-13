<?php

namespace Tests\PageController\Question\Show;

class Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'categories', 'er_categories_questions'],
        'ru'    => ['questions', 'revisions', 'categories', 'er_categories_questions'],
        'users' => ['users'],
    ];

    public function test__Get_EN_page()
    {
        $request = $this->createRequest('GET', '/en/Where_i_am_born');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Where i am born? – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Get_page_with_double_underscore()
    {
        $request = $this->createRequest('GET', '/en/What_does_FILE__NAME_mean');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('What does FILE_NAME mean? – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Get_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/%D0%9A%D0%B0%D0%BA_%D0%B4%D0%B5%D0%BB%D0%B0');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Get_page_by_old_URL()
    {
        $request = $this->createRequest('GET', '/ru/10/kak-otrastit-borodu');
        $response = $this->request($request);

        $this->assertSame(301, $response->getStatusCode());
    }
}
