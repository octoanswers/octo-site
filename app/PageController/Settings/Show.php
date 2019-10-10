<?php

namespace PageController\Settings;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        if (!$this->authUser) {
            $data = ['msg' => 'You not logged'];

            return $response->withJson($data, 404);
        }

        parent::handleRequest($request, $response, $args);

        $this->template = 'settings';
        $this->pageTitle = $this->translator->get('Settings') . ' – ' . __('common.answeropedia');

        $this->includeJS[] = 'user/upload_avatar';
        $this->includeJS[] = 'user/update_name';
        $this->includeJS[] = 'user/update_signature';
        $this->includeJS[] = 'user/update_site';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
