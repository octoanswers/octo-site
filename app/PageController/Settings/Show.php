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

        parent::handleRequest($request, $response, $args);
        
        $this->template = 'settings';
        $this->pageTitle = $this->translator->get('Settings').' – '.$this->translator->get('answeropedia');

        $this->includeJS[] = 'user/upload_avatar';
        $this->includeJS[] = 'user/update_name';
        $this->includeJS[] = 'user/update_signature';
        $this->includeJS[] = 'user/update_site';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
