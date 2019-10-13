<?php

namespace Tests\PageController\Answer\Edit;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'en' => ['questions'],
        'ru' => ['questions'],
    ];

    public function testBase()
    {
        $request = $this->createRequest('GET', '/en/answer/13/edit');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('What is you dream? – Edit answer – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Show_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/answer/13/edit');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
