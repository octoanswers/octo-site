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

        $questions = (new \Query\Questions($this->lang))->find_newest_with_answer(1, 5);


        foreach ($questions as $question) {

            $contributors_array = (new \Query\Contributors($this->lang))->find_answer_contributors($question->id);
            foreach ($contributors_array as $contributor) {
                $this->contributors[$question->id][] = $contributor;
            }

            $last_contributor = (new \Query\Contributor($this->lang))->find_answer_last_editor($question->id);

            $categories = (new \Query\Categories($this->lang))->categories_for_question_with_ID($question->id);
            if (count($categories) > 2) {
                $categories = array_slice($categories, 0, 2);
            }



            $this->topQuestions[] = [
                'question' => $question,
                'categories' => $categories,
                'last_contributor' => $last_contributor
            ];
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
