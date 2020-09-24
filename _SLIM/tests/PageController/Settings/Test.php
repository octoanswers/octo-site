<?php

namespace Tests\PageController\Settings;

class Test extends \Test\TestCase\Frontend
{
    public function test__Error_for_unlogged_user()
    {
        $request = $this->createRequest('GET', '/en/settings');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('You not logged', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(404, $response->getStatusCode());
    }
}
