<?php

namespace APIController\POST\Answers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Render extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $args['lang'];

            $text_MD = urldecode((string) $request->getParam('text'));

            $parsedown = new \Helper\ExtendedParsedown($lang);
            $text_HTML = $parsedown->text($text_MD);

            $output = [
                'lang'      => $lang,
                'text_md'   => $text_MD,
                'text_html' => $text_HTML,
            ];
        } catch (\Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
