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

    private $verot_upload = null;

    public function handle(Request $request, Response $response, $args)
    {
        try {

            // Check params

            if ($_FILES['upload_image_form__image_file']['size'] == 0 || $_FILES['upload_image_form__image_file']['name'] == '') {
                throw new Exception('No file was selected for upload', 1);
            }

            $this->lang = $args['lang'];

            $question_id = (int) $args['id'];
            $this->question = (new Question_Query($this->lang))->question_with_ID($question_id);

            if (!$this->question) {
                throw new Exception('No QUESTION', 0);
            }

            $API_key = $request->getParam('api_key');
            $this->user = (new User_Query())->user_with_API_key($API_key);

            if (!$this->user) {
                throw new Exception('No user', 0);
            }

            // Upload image

            $this->verot_upload = new upload($_FILES['upload_image_form__image_file']);
            if ($this->verot_upload->uploaded) {
                $image_base_bame = $this->_get_image_base_bame();

                $this->_make_user_avatar_with_size($image_base_bame . '_lg', self::WIDTH_LG);
                $this->_make_user_avatar_with_size($image_base_bame . '_md', self::WIDTH_MD);

                // delete the original uploaded file
                $this->verot_upload->clean();
            } else {
                throw new Exception('Image don`t upload', 0);
            }

            // Update question image base name
            $this->question->image_base_bame = $image_base_bame;
            $this->question = (new \Mapper\Question($this->lang))->update($this->question);

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

    protected function _make_user_avatar_with_size($image_filename, $image_width)
    {
        $uploadFolder = self::UPLOAD_FOLDER . '/' . $this->lang . '/' . $this->question->id . '/';

        $this->verot_upload->allowed = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        $this->verot_upload->image_convert = 'jpg';
        $this->verot_upload->jpeg_quality = self::JPEG_QUALITY;
        $this->verot_upload->image_resize = true;
        $this->verot_upload->image_ratio_crop = true;
        $this->verot_upload->file_overwrite = true;
        $this->verot_upload->image_x = $image_width;
        $this->verot_upload->image_y = (int) ($image_width * (1 / 2) - 10);
        $this->verot_upload->file_src_name_body = $image_filename;
        $this->verot_upload->process($uploadFolder);
        if ($this->verot_upload->processed) {
            return $this->verot_upload->file_dst_pathname;
        } else {
            return $this->verot_upload->error;
        }
    }

    protected function _get_image_base_bame()
    {
        $dateChunk = date('Ymj');
        $rand = mt_rand(1, 999);

        return $this->user->id . '_' . $dateChunk . '_' . $rand;
    }
}
