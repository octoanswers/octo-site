<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class InternalServerError_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $this->template = 'error/500';
        $this->pageTitle = _("internal_server_error", "page_title").' - '.$this->translator->get('answeropedia');
        $this->pageDescription = _("internal_server_error", "page_title");

        $this->errorTitle = _("internal_server_error", "page_title");
        $this->errorDescription = _("internal_server_error", "page_title");
        $this->includeJS[] = 'goal/error_404';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response->withStatus(500);
    }
}
