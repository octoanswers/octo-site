<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Login_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $this->l = Localizer::getInstance($this->lang);

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
            if (!$passHash->check_password($user->getPasswordHash(), $userPassword)) {
                throw new Exception('WRONG_PASSWORD', 1);
            }

            if (!isset($cookieStorage) || !is_a($cookieStorage, 'CookieStorage')) {
                $cookieStorage = new CookieStorage();
            }
            $cookieStorage->saveUser($user);

            $output = [
                'lang' => $this->lang,
                'id' => $user->getID(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'api_key' => $user->getAPIKey(),
                'created_at' => $user->getCreatedAt(),
                'url' => $user->getURL($this->lang),
                'destination_url' => Page_URL_Helper::getMainURL($this->lang),
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
