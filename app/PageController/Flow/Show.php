<?php

namespace PageController\Flow;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    protected $recent_questions;
    protected $parsedown;
    protected $contributors;
    protected $activities;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];

        $this->activities = (new \Query\Flow($this->lang))->findFlow();

        $human_date_timezone = new \DateTimeZone('UTC');
        $date_humanizer = new \Humanizer\HumanDate\HumanDate($human_date_timezone, $this->lang);

        foreach ($this->activities as &$activity) {
            $activity['data'] = json_decode($activity['data'], true);
            if (json_last_error()) {
                $activity['activity_type'] = 'JSON_DECODE_ERROR';
                continue;
            }
            $activity['created_at__humanized'] = $date_humanizer->format($activity['created_at']);
        }

        $this->template = 'flow';
        $this->pageTitle = __('page_flow.page_title') . ' – ' . __('common.answeropedia');
        $this->pageDescription = __('page_flow.note');
        $this->canonicalURL = \Helper\URL\Page::getFlowURL($this->lang);

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => SITE_URL,
            'type'        => 'website',
            'title'       => __('page_flow.page_title') . ' – ' . __('common.answeropedia'),
            'description' => __('page_flow.note'),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }
}
