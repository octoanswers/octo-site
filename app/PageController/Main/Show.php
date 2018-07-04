<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Show_Main_PageController extends Abstract_PageController
{
    protected $recent_questions;
    protected $parsedown;
    protected $contributors;
    protected $activities;

    protected $topics;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];
        $this->l = Localizer::getInstance($this->lang);

        $this->recent_questions = (new Questions_Query($this->lang))->findNewestWithAnswer(1, 5);

        // foreach ($this->recent_questions as $question) {
        //     $topicsTitles = Topic_Extractor_Helper::extractTopics($question->getAnswer()->getText());
        //     foreach ($topicsTitles as $title) {
        //         $topic = Topic_Model::initWithTitle($title);
        //         $this->topics[$question->getID()][] = $topic;
        //     }
        // }

        foreach ($this->recent_questions as $question) {
            $contributors_array = (new Contributors_Query($this->lang))->findAnswerContributors($question->getID());
            foreach ($contributors_array as $contributor) {
                $this->contributors[$question->getID()][] = $contributor;
            }
        }

        $this->parsedown = new ExtendedParsedown($this->lang);

        $this->template = 'main/show';
        $this->pageTitle = $this->l->t('octoanswers').' - '.$this->l->t('main_pg__title');
        $this->pageDescription = $this->l->t('main_pg__description');
        $this->canonicalURL = Page_URL_Helper::getMainURL($this->lang);

        $this->openGraph = $this->_getOpenGraph();

        $this->shareLink['title'] = $this->l->t('main_pg__title').' - '.$this->l->t('octoanswers');
        $this->shareLink['description'] = $this->l->t('main_pg__description');
        $this->shareLink['url'] = SITE_URL;
        $this->shareLink['image'] = SITE_URL.'/assets/img/og-image.png';

        $this->additionalJavascript[] = 'question/create';
        $this->additionalJavascript[] = 'question/create_from_main';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => SITE_URL,
            'type' => "website",
            'title' => $this->l->t('octoanswers').' - '.$this->l->t('main_pg__title'),
            'description' => $this->l->t('main_pg__description'),
            'locale' => $this->lang,
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }
}
