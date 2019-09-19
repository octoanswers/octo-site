<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class InternalServerError_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        // Don`t execute parent::handleRequest. Method have specific args.
        $this->lang = $lang;
        $this->translator = new \Helper\Translator('en', ROOT_PATH . '/app/Lang');

        $this->template = 'error/500';
        $this->pageTitle = $this->translator->get('error_page', 'internal_server_error', 'page_title') . ' – ' . $this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get('error_page', 'internal_server_error', 'page_title');

        $this->errorTitle = $this->translator->get('error_page', 'internal_server_error', 'page_title');
        $this->errorDescription = $this->translator->get('error_page', 'internal_server_error', 'page_title');
        $this->includeJS[] = 'goal/error_404';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(500);
    }
}
