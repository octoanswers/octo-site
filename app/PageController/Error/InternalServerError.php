<?php

namespace PageController\Error;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class InternalServerError extends \PageController\PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        $this->lang = $lang;

        $this->template = 'error/500';
        $this->pageTitle = __('page_error.internal_server_error.page_title') . ' – ' . __('common.answeropedia');
        $this->pageDescription = __('page_error.internal_server_error.page_title');

        $this->errorTitle = __('page_error.internal_server_error.page_title');
        $this->errorDescription = __('page_error.internal_server_error.page_title');
        $this->includeJS[] = 'goal/error_404';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(500);
    }
}
