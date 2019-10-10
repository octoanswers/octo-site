<?php

namespace PageController\Main;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    protected $parsedown;
    protected $contributors;
    protected $activities;

    protected $categories;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $this->top_questions = $this->_get_top_questions();

        $this->parsedown = new \Helper\ExtendedParsedown($this->lang);

        $this->question_about_answeropedia = $this->_get_about_answeropedia_question();

        $this->template = 'main';
        $this->pageTitle = __('common.answeropedia') . ' – ' . __('page_main.slogan');
        $this->pageDescription = $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->canonicalURL = \Helper\URL\Page::get_main_URL($this->lang);

        $this->open_graph = $this->_get_open_graph();

        $this->share_link['title'] = __('page_main.slogan') . ' – ' . __('common.answeropedia');
        $this->share_link['description'] = $this->translator->get('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->share_link['url'] = SITE_URL;
        $this->share_link['image'] = SITE_URL . '/assets/img/og-image.png';

        $this->includeJS[] = 'question/create';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _get_top_questions(): array
    {
        $top_questions = [];

        $questions = (new \Query\Questions($this->lang))->find_newest_with_answer(1, 5);

        foreach ($questions as $question) {
            $contributors = (new \Query\Contributors($this->lang))->find_answer_contributors($question->id);
            $last_contributor = (new \Query\Contributor($this->lang))->find_answer_last_editor($question->id);

            $categories = (new \Query\Categories($this->lang))->categories_for_question_with_ID($question->id);
            if (count($categories) > 2) {
                $categories = array_slice($categories, 0, 2);
            }

            $top_questions[] = [
                'question'         => $question,
                'categories'       => $categories,
                'contributors'     => $contributors,
                'last_contributor' => $last_contributor,
            ];
        }

        return $top_questions;
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => SITE_URL,
            'type'        => 'website',
            'title'       => __('common.answeropedia') . ' – ' . __('page_main.slogan'),
            'description' => __('page_main.description'),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }

    private function _get_about_answeropedia_question(): ?\Model\Question
    {
        try {
            $about_answeropedia_question_ID = $this->translator->get('service_id', 'about_answeropedia');
            $about_answeropedia_question = (new \Query\Question($this->lang))->question_with_ID($about_answeropedia_question_ID);
        } catch (\Throwable $e) {
            $about_answeropedia_question = null;
        }

        return $about_answeropedia_question;
    }
}
