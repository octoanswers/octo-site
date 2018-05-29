<?php

class Lang_SitemapXML_PageController extends Abstract_PageController
{
    const PAGE = 1;
    const QUESTIONS_PER_PAGE = 100;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->l = Localizer::getInstance($this->lang);

        $questions = (new Questions_Query($this->lang))->findNewest(self::PAGE, self::QUESTIONS_PER_PAGE);

        $output = '';
        $output .= '<?xml version="1.0" encoding="UTF-8"?>';
        $output .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

        foreach ($questions as $question) {
            $output .= '<url>';
            $output .= '<loc>'.Question_URL_Helper::getURL($this->lang, $question).'</loc>';
            $output .= '</url>';
        }

        $output .= '</urlset>';

        $response->getBody()->write($output);

        return $response->withHeader('Content-type', 'application/xml');
    }
}
