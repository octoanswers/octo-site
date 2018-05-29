<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Show_Settings_PageController extends Abstract_PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        if (!$this->authUser) {
            $data = array('msg' => 'You not logged');
            return $response->withJson($data, 404);
        }

        $this->lang = $args['lang'];
        $this->l = Localizer::getInstance($this->lang);

        $this->template = 'settings/show';
        $this->pageTitle = 'Настройки'.' - '.$this->l->t('octoanswers');

        $this->additionalJavascript[] = 'user/upload_avatar';
        $this->additionalJavascript[] = 'user/update_name';
        $this->additionalJavascript[] = 'user/update_signature';
        $this->additionalJavascript[] = 'user/update_site';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
