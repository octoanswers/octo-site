<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Logout extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');

            $post_params = $request->getParsedBody();
            $api_key = (string) $post_params['api_key'];

            $this->lang = $lang;

            \Validator\User::validateAPIKey($api_key);

            $user = (new \Query\User())->userWithAPIKey($api_key);

            $cookieStorage = new \Helper\CookieStorage();
            $cookieStorage->clear();

            $output = [
                'message'         => 'User unlogged',
                'destination_url' => \Helper\URL\Page::getMainURL($this->lang),
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
