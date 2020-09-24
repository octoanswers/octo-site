<?php

namespace PageController\Root;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $this->_detectUserLanguage($request);
        $this->__reinitTranslator($this->lang);

        $this->questionAboutAnsweropedia = $this->_getQuestionAboutAnsweropedia();

        $this->template = 'root';
        $this->showFooter = false;
        $this->pageTitle = __('common.answeropedia');
        $this->pageDescription = __('page_root.description');
        $this->canonicalURL = SITE_URL;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    //
    // Private Methods
    //

    private function _detectUserLanguage(Request $request): string
    {
        $supported_languages = \Helper\Lang::getSupportedLangs();

        $query_params = $request->getQueryParams();

        if (isset($query_params['lang'])) {
            $query_params_lang = $query_params['lang'];

            if (in_array($query_params_lang, $supported_languages)) {
                return $query_params_lang;
            }
        } elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($browser_lang, $supported_languages)) {
                return $browser_lang;
            }
        }

        $default_language = \Helper\Lang::getDefaultLang();

        return $default_language;
    }

    private function _getQuestionAboutAnsweropedia(): ?\Model\Question
    {
        try {
            $about_answeropedia_question_ID = (int) __('service_id.about_answeropedia');
            $about_answeropedia_question = (new \Query\Question($this->lang))->questionWithID($about_answeropedia_question_ID);
        } catch (\Throwable $e) {
            $about_answeropedia_question = null;
        }

        return $about_answeropedia_question;
    }
}
