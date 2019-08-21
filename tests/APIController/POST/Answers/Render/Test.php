<?php

class Render_Answers_POST_APIController_Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_Basic_query()
    {
        $textMD = "Any #birds may #fly.\n# Header\nText\n\nI eat [crisp](What is crisp?) every day.";
        $queryString = 'text=' . urlencode($textMD);
        $request = $this->__getTestRequest('POST', '/api/v1/ru/answers/render.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $textHTML = "<p>Any #birds may #fly.</p>\n";
        $textHTML .= "<h2>Header</h2>\n";
        $textHTML .= "<p>Text</p>\n";
        $textHTML .= '<p>I eat <a href="https://answeropedia.org/ru/What_is_crisp">crisp</a> every day.</p>';

        $expectedResponse = [
            'lang'      => 'ru',
            'text_md'   => $textMD,
            'text_html' => $textHTML,
        ];

        $actualResponse = json_decode($responseBody, true);

        $this->assertEquals($expectedResponse, $actualResponse);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_Empty_query()
    {
        $queryString = 'text=' . urlencode('');
        $request = $this->__getTestRequest('POST', '/api/v1/ru/answers/render.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'lang'      => 'ru',
            'text_md'   => '',
            'text_html' => '',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
