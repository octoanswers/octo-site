<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class InternalServerError_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        $this->lang = $lang;
        $this->l = Localizer::getInstance($this->lang);

        $this->template = 'error/500';
        $this->pageTitle = $this->l->t('error_500__page_title').' - '._('OctoAnswers');
        $this->pageDescription = $this->l->t('Error on octoanswers.com: ');

        $this->errorTitle = $this->l->t('error_pg__title_500');
        $this->errorDescription = $this->l->t('This page has been moved or deleted.', 'Error description', 'Errors');
        $this->additionalJavascript[] = 'goal/error_404';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response->withStatus(500);
    }
}
