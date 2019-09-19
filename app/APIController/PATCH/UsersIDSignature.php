<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersIDSignature_PATCH_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $api_key = (string) $request->getParam('api_key');
            $user_ID = (int) $args['id'];
            $signature = $request->getParam('signature');

            // Validate params

            if (!$signature) {
                throw new Exception('User "signature" property null must be a string', 0);
            }

            $user = (new User_Query())->user_with_API_key($api_key);
            $old_signature = $user->signature;

            if ($user->id != $user_ID) {
                throw new \Exception('Incorrect user id or API-key', 0);
            }

            // Change user signature

            $user->signature = $signature;
            $user = (new User_Mapper())->update($user);

            // Create activity

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::U_UPDATE_SIGNATURE;
            $activity->subject = $user;
            $activity->data = ['signature' => $signature];
            $activity = (new UUpdateSignature_Activity_Mapper($this->lang))->create($activity);

            $output = [
                'user' => [
                    'id'            => $user->id,
                    'name'          => $user->name,
                    'signature_old' => $old_signature,
                    'signature_new' => $signature,
                ],
                'message' => 'Signature saved!',
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
