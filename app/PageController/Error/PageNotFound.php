<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class PageNotFound_Error_PageController extends Abstract_PageController
{
    public function handle(string $lang, Request $request, Response $response, $args): Response
    {
        $this->lang = $lang;
        //$this->lang = $args['lang'] ? $args['lang'] : 'en';

        $this->l = Localizer::getInstance($this->lang);

        $this->template = 'error/404';
        $this->pageTitle = $this->l->t('Страница не найдена').' — '.$this->l->t('octoanswers');
        $this->pageDescription = $this->l->t('Страница не найден на OctoAnswers.org');
        $this->additionalJavascript[] = 'goal/page_not_found';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }
}
