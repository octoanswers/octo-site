<?php

namespace Tests\PageController\Root\Show;

class Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = [
        'ru'    => ['questions', 'revisions', 'categories'],
        'users' => ['users'],
    ];

    public function testBase()
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }
}
