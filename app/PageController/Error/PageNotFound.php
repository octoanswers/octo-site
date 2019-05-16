<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class PageNotFound_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        // Don`t execute parent::handleRequest. Method have specific args.
        $this->lang = $lang;
        $this->translator = new Translator($this->lang, ROOT_PATH."/app/Lang");

        $this->template = 'error/404';
        $this->pageTitle = _("page_not_found", "page_title").' — '.$this->translator->get('answeropedia');
        $this->pageDescription = _("page_not_found", "page_title");
        $this->includeJS[] = 'goal/page_not_found';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }
}
