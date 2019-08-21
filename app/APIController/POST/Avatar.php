<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// @TODO So bad, but... https://www.verot.net/php_class_upload_forum.htm?php_class_upload_forum_id=4739&php_class_upload_forum_thread_id=4739&lang=en-GB
require_once ROOT_PATH . '/vendor/verot/class.upload.php/src/class.upload.php';

class Avatar_POST_APIController extends Abstract_APIController
{
    const JPEG_QUALITY = 90;

    private $uploadFolder = ROOT_PATH . '/uploads/avatar/';

    private $handle = null;

    public function handle(Request $request, Response $response, $args)
    {
        try {
            if ($_FILES['new_avatar_file']['size'] == 0 || $_FILES['new_avatar_file']['name'] == '') {
                throw new Exception('No file was selected for upload', 1);
            }

            $APIKey = $request->getParam('api_key');
            $user = (new User_Query())->userWithAPIKey($APIKey);

            $this->handle = new upload($_FILES['new_avatar_file']);
            if ($this->handle->uploaded) {
                $mediumAvatarFile = $this->__makeUserAvatarWithSize($user->id, 400);
                $smallAvatarFile = $this->__makeUserAvatarWithSize($user->id, 200);
                $extraSmallAvatarFile = $this->__makeUserAvatarWithSize($user->id, 100);

                // delete the original uploaded file
                $this->handle->clean();
            } else {
                throw new Exception('Avatar don`t upload', 1);
            }

            $output = [
                'user_id'                => true,
                'avatar_url_medium'      => $user->get_avatar_URL_large(),
                'avatar_url_small'       => $user->get_avatar_URL_medium(),
                'avatar_url_extra_small' => $user->get_avatar_URL_small(),
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

    protected function __makeUserAvatarWithSize($userID, $avatarSize)
    {
        $avatarFilename = $userID . '_' . $avatarSize;

        $this->handle->allowed = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        $this->handle->image_convert = 'jpg';
        $this->handle->jpeg_quality = self::JPEG_QUALITY;
        $this->handle->image_resize = true;
        $this->handle->image_ratio_crop = true;
        $this->handle->file_overwrite = true;
        $this->handle->image_y = $avatarSize;
        $this->handle->image_x = $avatarSize;
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
