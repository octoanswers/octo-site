<?php

namespace Tests\APIController\POST\Answers\Render;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_Basic_query()
    {
        $textMD = "Any #birds may #fly.\n# Header\nText\n\nI eat [crisp](What is crisp?) every day.";

        $uri = '/api/v1/ru/answers/render.json';
        $post_data = ['text' =>  urlencode($textMD)];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $textHTML = "<p>Any #birds may #fly.</p>\n";
        $textHTML .= "<h2>Header</h2>\n";
        $textHTML .= "<p>Text</p>\n";
        $textHTML .= '<p>I eat <a href="https://answeropedia.org/ru/What_is_crisp">crisp</a> every day.</p>';

        $expected_response = [
            'lang'      => 'ru',
            'text_md'   => $textMD,
            'text_html' => $textHTML,
        ];

        $actualResponse = json_decode($response_body, true);

        $this->assertEquals($expected_response, $actualResponse);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Empty_query()
    {
        $uri = '/api/v1/ru/answers/render.json';
        $post_data = ['text' =>  urlencode('')];

        $request = $this->createRequest('POST', $uri);
        $request = $this->withFormData($request, $post_data);

        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'lang'      => 'ru',
            'text_md'   => '',
            'text_html' => '',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
