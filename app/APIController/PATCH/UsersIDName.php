<?php

namespace APIController\PATCH;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDName extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $api_key = (string) $request->getParam('api_key');
            $user_ID = (int) $args['id'];
            $name = $request->getParam('name');

            // Validate params

            if (!$name) {
                throw new \Exception('User "name" property null must be a string', 0);
            }

            $user = (new \Query\User())->user_with_API_key($api_key);
            $old_name = $user->name;

            if ($user->id != $user_ID) {
                throw new \Exception('Incorrect user id or API-key', 0);
            }

            // Change user signature

            $user->name = $name;
            $user = (new \Mapper\User())->update($user);

            $output = [
                'user' => [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'name_old' => $old_name,
                ],
                'message' => 'Name saved!',
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
