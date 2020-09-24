<?php

namespace Tests\PageController\Error\QuestionNotFound;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Get_some_unfounded_question()
    {
        $request = $this->createRequest('GET', '/en/Some_unfounded_question');
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $this->assertStringContainsString('Question not found – Some unfounded question? – Answeropedia', $response_body);

        $this->assertStringNotContainsString('Notice:', $response_body);
        $this->assertStringNotContainsString('Warning:', $response_body);

        $this->assertSame(404, $response->getStatusCode());
    }
}
