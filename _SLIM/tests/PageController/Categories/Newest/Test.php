<?php

namespace Tests\PageController\Categories\Newest;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en' => ['categories'],
        'ru' => ['categories'],
    ];

    public function test__Show_EN_page()
    {
        $request = $this->createRequest('GET', '/en/categories/newest');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('New categories – Page 1 – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/categories/newest');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
