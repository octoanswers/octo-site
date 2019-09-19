<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show_Main_PageController extends Abstract_PageController
{
    protected $recent_questions;
    protected $parsedown;
    protected $contributors;
    protected $activities;

    protected $categories;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $this->recent_questions = (new \Query\Questions($this->lang))->find_newest_with_answer(1, 5);

        // foreach ($this->recent_questions as $question) {
        //     $categoriesTitles = Category_Extractor_Helper::extractCategories($question->answer->text);
        //     foreach ($categoriesTitles as $title) {
        //         $category = \Model\Category::init_with_title($title);
        //         $this->categories[$question->id][] = $category;
        //     }
        // }

        foreach ($this->recent_questions as $question) {
            $contributors_array = (new \Query\Contributors($this->lang))->find_answer_contributors($question->id);
            foreach ($contributors_array as $contributor) {
                $this->contributors[$question->id][] = $contributor;
            }
        }

        $this->parsedown = new \Helper\ExtendedParsedown($this->lang);

        $this->template = 'main';
        $this->pageTitle = $this->translator->get('answeropedia') . ' – ' . $this->translator->get('main', 'slogan');
        $this->pageDescription = $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->canonicalURL = \Helper\URL\Page::get_main_URL($this->lang);

        $this->open_graph = $this->_get_open_graph();

        $this->share_link['title'] = $this->translator->get('main', 'slogan') . ' – ' . $this->translator->get('answeropedia');
        $this->share_link['description'] = $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->share_link['url'] = SITE_URL;
        $this->share_link['image'] = SITE_URL . '/assets/img/og-image.png';

        $this->includeJS[] = 'question/create';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => SITE_URL,
            'type'        => 'website',
            'title'       => $this->translator->get('answeropedia') . ' – ' . $this->translator->get('main', 'slogan'),
            'description' => $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.'),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }
}
