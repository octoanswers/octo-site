<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Logout_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $apiKey = (string) $request->getParam('api_key');

            User_Validator::validateAPIKey($apiKey);

            $user = (new User_Query())->userWithAPIKey($apiKey);

            if (!isset($cookieStorage) || !is_a($cookieStorage, 'CookieStorage')) {
                $cookieStorage = new CookieStorage();
            }
            $cookieStorage->clear();

            $output = [
                'message'         => 'User unlogged',
                'destination_url' => Page_URL_Helper::getMainURL($this->lang),
            ];
        } catch (Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
