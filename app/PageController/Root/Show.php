<?php

namespace PageController\Root;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $supported_languages = \Lang::get_supported_langs();
        $default_language = \Lang::get_default_lang();

        $this->lang = $default_language;
        $this->translator = new \Helper\Translator($this->lang, ROOT_PATH . '/app/Lang');

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (!in_array($this->lang, $supported_languages)) {
                $this->lang = $default_language;
            }
        }

        $this->template = 'root';
        $this->showFooter = false;
        $this->pageTitle = $this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get('Questions and Answers');
        $this->canonicalURL = SITE_URL;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
