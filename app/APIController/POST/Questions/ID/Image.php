<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/*
 @todo So bad, but... https://www.verot.net/php_class_upload_forum.htm?php_class_upload_forum_id=4739&php_class_upload_forum_thread_id=4739&lang=en-GB
*/

require_once ROOT_PATH . '/vendor/verot/class.upload.php/src/class.upload.php';

class Image_ID_Questions_POST_APIController extends Abstract_APIController
{
    const JPEG_QUALITY = 90;
    const WIDTH_LG = 1140;  // col-12 width
    const WIDTH_MD = 760;  // col-8 width
    const UPLOAD_FOLDER = ROOT_PATH . '/uploads/img';

    private $verotUpload = null;

    public function handle(Request $request, Response $response, $args)
    {
        try {

            // Check params

            if ($_FILES['upload_image_form__image_file']['size'] == 0 || $_FILES['upload_image_form__image_file']['name'] == '') {
                throw new Exception('No file was selected for upload', 1);
            }

            $this->lang = $args['lang'];

            $question_id = (int) $args['id'];
            $this->question = (new Question_Query($this->lang))->questionWithID($question_id);

            if (!$this->question) {
                throw new Exception('No QUESTION', 0);
            }

            $APIKey = $request->getParam('api_key');
            $this->user = (new User_Query())->userWithAPIKey($APIKey);

            if (!$this->user) {
                throw new Exception('No user', 0);
            }

            // Upload image

            $this->verotUpload = new upload($_FILES['upload_image_form__image_file']);
            if ($this->verotUpload->uploaded) {
                $imageBaseName = $this->_getImageBaseName();

                $this->_makeUserAvatarWithSize($imageBaseName . '_lg', self::WIDTH_LG);
                $this->_makeUserAvatarWithSize($imageBaseName . '_md', self::WIDTH_MD);

                // delete the original uploaded file
                $this->verotUpload->clean();
            } else {
                throw new Exception('Image don`t upload', 0);
            }

            // Update question image base name
            $this->question->imageBaseName = $imageBaseName;
            $this->question = (new Question_Mapper($this->lang))->update($this->question);

            $output = [
                'lang'         => $this->lang,
                'question_id'  => $this->question->id,
                'user_id'      => $this->user->id,
                'image_url_lg' => $this->question->get_image_URL_large($this->lang),
                'image_url_md' => $this->question->get_image_URL_medium($this->lang),
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

    protected function _makeUserAvatarWithSize($imageFilename, $imageWidth)
    {
        $uploadFolder = self::UPLOAD_FOLDER . '/' . $this->lang . '/' . $this->question->id . '/';

        $this->verotUpload->allowed = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        $this->verotUpload->image_convert = 'jpg';
        $this->verotUpload->jpeg_quality = self::JPEG_QUALITY;
        $this->verotUpload->image_resize = true;
        $this->verotUpload->image_ratio_crop = true;
        $this->verotUpload->file_overwrite = true;
        $this->verotUpload->image_x = $imageWidth;
        $this->verotUpload->image_y = (int) ($imageWidth * (1 / 2) - 10);
        $this->verotUpload->file_src_name_body = $imageFilename;
        $this->verotUpload->process($uploadFolder);
        if ($this->verotUpload->processed) {
            return $this->verotUpload->file_dst_pathname;
        } else {
            return $this->verotUpload->error;
        }
    }

    protected function _getImageBaseName()
    {
        $dateChunk = date('Ymj');
        $rand = mt_rand(1, 999);

        return $this->user->id . '_' . $dateChunk . '_' . $rand;
    }
}
