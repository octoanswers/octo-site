<?php

namespace PageController\Error;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserNotFound extends \PageController\PageController
{
    public function handle(Request $request, Response $response): Response
    {
        $lang = $request->getAttribute('lang');
        $this->username = $request->getAttribute('username');

        $this->lang = $lang;

        $this->template = 'error/user_not_found';
        $this->showFooter = false;
        $this->pageTitle = __('page_error.user_not_found.page_title') . ' – ' . $this->username . ' – ' . __('common.answeropedia');
        $this->pageDescription = __('page_error.user_not_found.page_title');

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }
}
