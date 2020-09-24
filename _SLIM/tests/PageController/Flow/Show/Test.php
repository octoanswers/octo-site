<?php

namespace Tests\PageController\Flow\Show;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en' => ['activities'],
        'ru' => ['activities'],
    ];

    public function test__Show_EN_page()
    {
        $request = $this->createRequest('GET', '/en/flow');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Flow – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Check_that_RU_page_is_exists()
    {
        $request = $this->createRequest('GET', '/ru/flow');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
