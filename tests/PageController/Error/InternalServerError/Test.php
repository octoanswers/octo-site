<?php

namespace Tests\PageController\Error\InternalServerError;

class Test extends \Tests\Frontend\TestCase
{
    public function test_Base()
    {
        $request = $this->createRequest('GET', '/en/answer/667/history');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Error 500 – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(500, $response->getStatusCode());
    }
}
