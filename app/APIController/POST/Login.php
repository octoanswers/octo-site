<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Login_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $userEmail = (string) $request->getParam('email');
            $userPassword = (string) $request->getParam('password');

            User_Validator::validateEmail($userEmail);
            User_Validator::validatePassword($userPassword);

            $user = (new User_Query())->userWithEmail($userEmail);
            if (!$user) {
                throw new Exception('User with specific email not found', 1);
            }

            // check user password
            $passHash = new PassHash();
            if (!$passHash->check_password($user->passwordHash, $userPassword)) {
                throw new Exception('WRONG_PASSWORD', 1);
            }

            $cookieStorage = new CookieStorage();
            $cookieStorage->saveUser($user);

            $output = [
                'lang'            => $this->lang,
                'id'              => $user->id,
                'email'           => $user->email,
                'name'            => $user->name,
                'api_key'         => $user->apiKey,
                'created_at'      => $user->createdAt,
                'url'             => $user->get_URL($this->lang),
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
