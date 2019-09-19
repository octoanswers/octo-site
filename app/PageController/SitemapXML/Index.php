<?php

namespace PageController\SitemapXML;

class Index extends \PageController\PageController
{
    public function handle($request, $response, $args)
    {
        $supportedLangs = \Lang::get_supported_langs();

        $output = '<?xml version="1.0" encoding="UTF-8"?>';
        $output .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';
        $output .= '<url>';
        $output .= '<loc>' . SITE_URL . '</loc>';
        foreach ($supportedLangs as $lang) {
            $url = \Helper\URL\Page::get_main_URL($lang);
            $output .= '<xhtml:link rel="alternate" hreflang="' . $lang . '" href="' . $url . '" />';
        }
        $output .= '</url>';
        $output .= '</urlset>';

        $response->getBody()->write($output);

        return $response->withHeader('Content-type', 'application/xml');
    }
}
