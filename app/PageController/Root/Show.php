<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Show_Root_PageController extends Abstract_PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $supported_languages = Lang::getSupportedLangs();
        $default_language = Lang::getDefaultLang();

        $this->lang = $default_language;
        $this->translator = new Translator($this->lang, ROOT_PATH."/app/Lang");

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (!in_array($this->lang, $supported_languages)) {
                $this->lang = $default_language;
            }
        }

        $this->template = 'root/show';
        $this->showFooter = false;
        $this->pageTitle = $this->translator->get('answeropedia');
        $this->pageDescription = _('Questions and Answers');
        $this->canonicalURL = SITE_URL;

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
