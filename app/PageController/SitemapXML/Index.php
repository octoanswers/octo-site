<?php

class Index_SitemapXML_PageController extends Abstract_PageController
{
    public function handle($request, $response, $args)
    {
        $supportedLangs = Lang::getSupportedLangs();

        $output = '<?xml version="1.0" encoding="UTF-8"?>';
        $output .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';        $output .= '<url>';
        $output .= '<loc>'.SITE_URL.'</loc>';
        foreach ($supportedLangs as $lang) {
            $url = Page_URL_Helper::getMainURL($lang);
            $output .= '<xhtml:link rel="alternate" hreflang="'.$lang.'" href="'.$url.'" />';

        }
        $output .= '</url>';
        $output .= '</urlset>';

        $response->getBody()->write($output);

        return $response->withHeader('Content-type', 'application/xml');
    }
}
