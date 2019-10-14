<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Login extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $post_params = $request->getParsedBody();

            $user_email = (string) $post_params['email'];
            $user_password = (string) $post_params['password'];

            \Validator\User::validateEmail($user_email);
            \Validator\User::validatePassword($user_password);

            $user = (new \Query\User())->userWithEmail($user_email);
            if (!$user) {
                throw new \Exception('User with specific email not found', 1);
            }

            // check user password
            $password_hash = new \Helper\PassHash();
            if (!$password_hash->checkPassword($user->passwordHash, $user_password)) {
                throw new \Exception('WRONG_PASSWORD', 1);
            }

            $cookieStorage = new \Helper\CookieStorage();
            $cookieStorage->saveUser($user);

            $output = [
                'lang'            => $this->lang,
                'id'              => $user->id,
                'email'           => $user->email,
                'name'            => $user->name,
                'api_key'         => $user->apiKey,
                'created_at'      => $user->createdAt,
                'url'             => $user->getURL($this->lang),
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
