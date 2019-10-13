<?php

namespace APIController\PATCH;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDSite extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $user_ID = (int) $args['id'];

            $query_params = $request->getQueryParams();
            $api_key = (string) $query_params['api_key'];
            $new_site = @$query_params['site'];

            // Validate params

            if (!$new_site) {
                throw new \Exception('User "site" property null must be a string', 0);
            }

            $user = (new \Query\User())->user_with_API_key($api_key);
            $old_site = $user->site;

            if ($user->id != $user_ID) {
                throw new \Exception('Incorrect user id or API-key', 0);
            }

            // Change user signature

            $user->site = $new_site;
            $user = (new \Mapper\User())->update($user);

            $output = [
                'user' => [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'site_old' => $old_site,
                    'site_new' => $new_site,
                ],
                'message' => 'User site saved!',
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
