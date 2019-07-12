<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Render_Answers_GET_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $args['lang'];

            $textMD = urldecode((string) $request->getParam('text'));

            $parsedown = new ExtendedParsedown($lang);
            $textHTML = $parsedown->text($textMD);

            $output = [
                'lang' => $lang,
                'text_md' => $textMD,
                'text_html' => $textHTML
            ];
        } catch (Throwable $e) {
            $output = [
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
