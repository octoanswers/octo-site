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

        $this->recent_questions = (new Questions_Query($this->lang))->findNewestWithAnswer(1, 5);

        // foreach ($this->recent_questions as $question) {
        //     $categoriesTitles = Category_Extractor_Helper::extractCategories($question->answer->text);
        //     foreach ($categoriesTitles as $title) {
        //         $category = Category_Model::initWithTitle($title);
        //         $this->categories[$question->id][] = $category;
        //     }
        // }

        foreach ($this->recent_questions as $question) {
            $contributors_array = (new Contributors_Query($this->lang))->findAnswerContributors($question->id);
            foreach ($contributors_array as $contributor) {
                $this->contributors[$question->id][] = $contributor;
            }
        }

        $this->parsedown = new ExtendedParsedown($this->lang);

        $this->template = 'main';
        $this->pageTitle = $this->translator->get('answeropedia') . ' – ' . $this->translator->get('Ask a question and get one complete answer');
        $this->pageDescription = $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->canonicalURL = Page_URL_Helper::getMainURL($this->lang);

        $this->openGraph = $this->_getOpenGraph();

        $this->share_link['title'] = $this->translator->get('Ask a question and get one complete answer') . ' – ' . $this->translator->get('answeropedia');
        $this->share_link['description'] = $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->share_link['url'] = SITE_URL;
        $this->share_link['image'] = SITE_URL . '/assets/img/og-image.png';

        $this->includeJS[] = 'question/create';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url'         => SITE_URL,
            'type'        => 'website',
            'title'       => $this->translator->get('answeropedia') . ' – ' . $this->translator->get('Ask a question and get one complete answer'),
            'description' => $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.'),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }
}
