<?php

namespace Tests\PageController\Search;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Base_query()
    {
        $request = $this->createRequest('GET', '/en/search?q=Apple');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Search: Apple – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__Empty_query_params()
    {
        $request = $this->createRequest('GET', '/en/search');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Search:  – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }
}
