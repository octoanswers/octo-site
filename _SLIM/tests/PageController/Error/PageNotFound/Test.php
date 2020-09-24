<?php

namespace Tests\PageController\Error\PageNotFound;

class Test extends \Test\TestCase\Frontend
{
    public function test_Base()
    {
        $request = $this->createRequest('GET', '/en/settings/some_unfounded_page');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Page not found', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(404, $response->getStatusCode());
    }
}
