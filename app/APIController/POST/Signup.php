<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Signup extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');

            $post_params = $request->getParsedBody();
            $username = $post_params['username'];
            $user_email = $post_params['email'];
            $user_password = $post_params['password'];

            \Validator\User::validateUsername($username);
            \Validator\User::validateEmail($user_email);
            \Validator\User::validatePassword($user_password);

            $user = (new \Query\User())->userWithEmail($user_email);
            if ($user) {
                throw new \Exception('User with specific email is already registered', 1);
            }

            $user = (new \Query\User())->userWithUsername($username);
            if ($user) {
                throw new \Exception('User with username "' . $username . '" is already registered', 0);
            }

            // Generating password hash
            $password_hash = new \Helper\PassHash();
            $user_password_hash = $password_hash->hash($user_password);
            $apiKey = $password_hash->generateAPIKey();

            // @TODO check API-key by doubles
            //$user = $api->get('users_api_key', ['api_key' => $api_key]);

            $name = $username;

            $user = new \Model\User();
            $user->username = $username;
            $user->name = $name;
            $user->email = $user_email;
            $user->passwordHash = $user_password_hash;
            $user->apiKey = $apiKey;

            $user = (new \Mapper\User())->create($user);

            $cookieStorage = new \Helper\CookieStorage();
            $cookieStorage->saveUser($user);

            $this->output = [
                'id'              => $user->id,
                'username'        => $user->username,
                'email'           => $user->email,
                'password_hash'   => $user->passwordHash,
                'api_key'         => $user->apiKey,
                'created_at'      => date('Y-m-d H:i:s'),
                'url'             => $user->getURL($lang),
                'destination_url' => \Helper\URL\Page::getMainURL($lang),
            ];

            $this->_copyDefaultAvatar($user->id);
        } catch (\Throwable $e) {
            $this->output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($this->output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }

    public function _copyDefaultAvatar(int $userID)
    {
        $uploadFolder = ROOT_PATH . '/uploads/avatar';
        $avatarSizes = [100, 200, 400];

        foreach ($avatarSizes as $size) {
            $fromFile = $uploadFolder . '/0_' . $size . '.jpg';
            $toFile = $uploadFolder . '/' . $userID . '_' . $size . '.jpg';

            if (!@copy($fromFile, $toFile)) {
                $errors = error_get_last();
                $this->output['avatar_' . $size] = 'Avatar file "' . $userID . '_' . $size . '.png" not copied: ' . $errors['type'] . ' ' . $errors['message'];
            } else {
                $this->output['avatar_' . $size] = 'Avatar file "' . $userID . '_' . $size . '.png" copied';
            }
        }
    }
}
