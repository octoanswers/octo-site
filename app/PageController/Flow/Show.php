<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Show_Flow_PageController extends Abstract_PageController
{
    protected $recent_questions;
    protected $parsedown;
    protected $contributors;
    protected $activities;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];
        $this->l = Localizer::getInstance($this->lang);

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
        };

        $this->template = 'flow/show';
        $this->pageTitle = _('Flow - Page title').' — '._('OctoAnswers');
        $this->pageDescription = _('Flow - Page description');
        $this->canonicalURL = Page_URL_Helper::getFlowURL($this->lang);

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => SITE_URL,
            'type' => "website",
            'title' => _('Flow - Page title').' - '._('OctoAnswers'),
            'description' => _('Flow - Page description'),
            'locale' => $this->lang,
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }
}
