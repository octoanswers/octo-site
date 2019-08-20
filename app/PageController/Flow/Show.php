<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show_Flow_PageController extends Abstract_PageController
{
    protected $recent_questions;
    protected $parsedown;
    protected $contributors;
    protected $activities;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $this->activities = (new Flow_Query($this->lang))->findFlow();

        $human_date_timezone = new DateTimeZone('UTC');
        $date_humanizer = new HumanDate($human_date_timezone, $this->lang);

        foreach ($this->activities as &$activity) {
            $activity['data'] = json_decode($activity['data'], true);
            if (json_last_error()) {
                $activity['activity_type'] = 'JSON_DECODE_ERROR';
                continue;
            }
            $activity['created_at__humanized'] = $date_humanizer->format($activity['created_at']);
        }

        $this->template = 'flow';
        $this->pageTitle = $this->translator->get('flow', 'page_title').' – '.$this->translator->get('answeropedia');
        $this->pageDescription = $this->translator->get('Questions and answers flow on Answeropedia.');
        $this->canonicalURL = Page_URL_Helper::getFlowURL($this->lang);

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url'         => SITE_URL,
            'type'        => 'website',
            'title'       => $this->translator->get('flow', 'page_title').' – '.$this->translator->get('answeropedia'),
            'description' => $this->translator->get('Questions and answers flow on Answeropedia.'),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL.'/og-image.png',
        ];

        return $og;
    }
}
