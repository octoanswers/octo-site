<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class InternalServerError_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $this->template = 'error/500';
        $this->pageTitle = _('Error 500').' - '.$this->translator->get('answeropedia');
        $this->pageDescription = _('Error 500');

        $this->errorTitle = _('Error 500');
        $this->errorDescription = _('Error 500');
        $this->includeJS[] = 'goal/error_404';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response->withStatus(500);
    }
}
