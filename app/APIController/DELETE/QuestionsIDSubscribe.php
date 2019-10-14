<?php

namespace APIController\DELETE;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDSubscribe extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $lang = $request->getAttribute('lang');

        try {
            $output = [
                'error_code'    => 0,
                'error_message' => 'API not realized',
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
