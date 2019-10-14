<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Avatar extends \APIController\APIController
{
    const JPEG_QUALITY = 90;

    private $uploadFolder = ROOT_PATH . '/uploads/avatar/';

    private $handle = null;

    public function handle(Request $request, Response $response, $args)
    {
        try {
            if ($_FILES['new_avatar_file']['size'] == 0 || $_FILES['new_avatar_file']['name'] == '') {
                throw new \Exception('No file was selected for upload', 1);
            }

            $post_params = $request->getParsedBody();

            $API_key = $post_params['api_key'];
            $user = (new \Query\User())->userWithAPIKey($API_key);

            $this->handle = new \Verot\Upload\Upload($_FILES['new_avatar_file']);
            if ($this->handle->uploaded) {
                $medium_avatar_file = $this->_makeUserAvatarWithSize($user->id, 400);
                $small_avatar_file = $this->_makeUserAvatarWithSize($user->id, 200);
                $extra_small_avatar_file = $this->_makeUserAvatarWithSize($user->id, 100);

                // Save flag is_avatar_uploaded
                $user->is_avatar_uploaded = true;

                $user_mapper = new \Mapper\User();
                $user = $user_mapper->update($user);
                $user_mapper = null;

                // Update avatar URL in cookies
                $cookie_storage = new \Helper\CookieStorage();
                $cookie_storage->saveUser($user);

                // delete the original uploaded file
                $this->handle->clean();
            } else {
                throw new \Exception('Avatar don`t upload', 1);
            }

            $output = [
                'user_id'                 => true,
                'avatar_url_medium'       => $user->getAvatarURLLarge(),
                'avatar_url_small'        => $user->getAvatarURLMedium(),
                'avatar_url_extra_small'  => $user->getAvatarURLSmall(),
                'avatar_file_medium'      => $medium_avatar_file,
                'avatar_file_small'       => $small_avatar_file,
                'avatar_file_extra_small' => $extra_small_avatar_file,
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

    protected function _makeUserAvatarWithSize($user_ID, $avatar_size)
    {
        $avatarFilename = $user_ID . '_' . $avatar_size;

        $this->handle->allowed = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        $this->handle->image_convert = 'jpg';
        $this->handle->jpeg_quality = self::JPEG_QUALITY;
        $this->handle->image_resize = true;
        $this->handle->image_ratio_crop = true;
        $this->handle->file_overwrite = true;
        $this->handle->image_y = $avatar_size;
        $this->handle->image_x = $avatar_size;
        $this->handle->file_src_name_body = $avatarFilename;
        $this->handle->process($this->uploadFolder);
        if ($this->handle->processed) {
            $avatarFile = $this->handle->file_dst_pathname;

            return $avatarFile;
        } else {
            return $this->handle->error;
        }
    }
}
