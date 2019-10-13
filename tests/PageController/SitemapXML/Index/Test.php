<?php

namespace Tests\PageController\SitemapXML\Index;

class Test extends \Tests\Frontend\TestCase
{
    public function test__Base()
    {
        $request = $this->createRequest('GET', '/sitemap.xml');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('https://answeropedia.org/en', $response_body);
        $this->assertStringContainsString('https://answeropedia.org/ru', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }
}
