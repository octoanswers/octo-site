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
        $this->translator = new \Helper\Translator\Translator($this->lang, ROOT_PATH . '/app/Lang');

        $this->template = 'error/404';
        $this->pageTitle = $this->translator->get('page__404', 'page_title') . ' – ' . $this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get('page__404', 'page_title');
        $this->includeJS[] = 'goal/page_not_found';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }
}
