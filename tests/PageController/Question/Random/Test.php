<?php

namespace Tests\PageController\Question\Random;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Get_EN_page()
    {
        $request = $this->createRequest('GET', '/en/random-question');
        $response = $this->request($request);

        $this->assertSame(303, $response->getStatusCode());
    }
}
