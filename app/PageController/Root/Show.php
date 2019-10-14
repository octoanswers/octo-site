<?php

namespace PageController\Root;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $supported_languages = \Helper\Lang::getSupportedLangs();
        $default_language = \Helper\Lang::getDefaultLang();

        $this->lang = $default_language;

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (!in_array($this->lang, $supported_languages)) {
                $this->lang = $default_language;
            }
        }

        $this->template = 'root';
        $this->showFooter = false;
        $this->pageTitle = __('common.answeropedia');
        $this->pageDescription = __('page_root.description');
        $this->canonicalURL = SITE_URL;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
