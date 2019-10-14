<?php

namespace Tests\PageController\Question\ShortURL;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Get_EN_page()
    {
        $request = $this->createRequest('GET', '/en/13');
        $response = $this->request($request);

        $this->assertSame(301, $response->getStatusCode());
    }
}
