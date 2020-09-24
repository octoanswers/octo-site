<?php

namespace Tests\Front\Page\Question\Ask;

class Test extends \Test\TestCase\Frontend
{
    public function test__Get_EN_page()
    {
        $request = $this->createRequest('GET', '/en/ask');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Ask Question – Answeropedia', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Check_RU_page()
    {
        $request = $this->createRequest('GET', '/ru/ask');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
