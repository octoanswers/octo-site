<?php

namespace PageController\Error;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserNotFound extends \PageController\PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        // Don`t execute parent::handleRequest. Method have specific args.
        $this->lang = $lang;

        $this->username = $args['username'];

        $this->template = 'error/user_not_found';
        $this->showFooter = false;
        $this->pageTitle = __('page_error.user_not_found.page_title') . ' – ' . $this->username . ' – ' . __('common.answeropedia');
        $this->pageDescription = __('page_error.user_not_found.page_title');

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }
}
