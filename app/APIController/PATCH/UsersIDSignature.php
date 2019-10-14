<?php

namespace APIController\PATCH;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDSignature extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $query_params = $request->getQueryParams();
            $api_key = (string) $query_params['api_key'];
            $user_ID = (int) $args['id'];
            $signature = @$query_params['signature'];

            // Validate params

            if (!$signature) {
                throw new \Exception('User "signature" property null must be a string', 0);
            }

            $user = (new \Query\User())->userWithAPIKey($api_key);
            $old_signature = $user->signature;

            if ($user->id != $user_ID) {
                throw new \Exception('Incorrect user id or API-key', 0);
            }

            // Change user signature

            $user->signature = $signature;
            $user = (new \Mapper\User())->update($user);

            // Create activity

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::U_UPDATE_SIGNATURE;
            $activity->subject = $user;
            $activity->data = ['signature' => $signature];
            $activity = (new \Mapper\Activity\UUpdateSignature($this->lang))->create($activity);

            $output = [
                'user' => [
                    'id'            => $user->id,
                    'name'          => $user->name,
                    'signature_old' => $old_signature,
                    'signature_new' => $signature,
                ],
                'message' => 'Signature saved!',
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
