<?php

namespace PageController\Error;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PageNotFound extends \PageController\PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        // Don`t execute parent::handleRequest. Method have specific args.
        $this->lang = $lang;

        $this->template = 'error/404';
        $this->pageTitle = __('page_error.404.page_title') . ' – ' . __('common.answeropedia');
        $this->pageDescription = __('page_error.404.page_title');
        $this->includeJS[] = 'goal/page_not_found';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }
}
