<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UsersIDSignature_PATCH_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            
            $api_key = (string) $request->getParam('api_key');
            $userID = (int) $args['id'];
            $signature = $request->getParam('signature');

            # Validate params

            if (!$signature) {
                throw new Exception('User "signature" property null must be a string', 0);
            }

            $user = (new User_Query())->userWithAPIKey($api_key);
            $old_signature = $user->getSignature();

            if ($user->getID() != $userID) {
                throw new \Exception("Incorrect user id or API-key", 0);
            }

            # Change user signature

            $user->setSignature($signature);
            $user = (new User_Mapper())->update($user);

            # Create activity

            $activity = new Activity_Model();
            $activity->type = Activity_Model::U_UPDATE_SIGNATURE;
            $activity->subject = $user;
            $activity->data = ['signature' => $signature];
            $activity = (new UUpdateSignature_Activity_Mapper($this->lang))->create($activity);

            $output = [
                'user' => [
                    'id' => $user->getID(),
                    'name' => $user->getName(),
                    'signature_old' => $old_signature,
                    'signature_new' => $signature,
                ],
                'message' => 'Signature saved!',
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
