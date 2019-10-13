<?php

namespace Tests\PageController\SitemapXML\Lang;

class Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = [
        'en'    => ['questions', 'revisions', 'er_users_follow_users'],
        'ru'    => ['questions', 'revisions', 'er_users_follow_users'],
        'users' => ['users'],
    ];

    public function test__EN_sitemap()
    {
        $request = $this->createRequest('GET', '/en/sitemap.xml');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('https://answeropedia.org/en/How_developers_made_interesting_games', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test__RU_sitemap()
    {
        $request = $this->createRequest('GET', '/ru/sitemap.xml');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}
