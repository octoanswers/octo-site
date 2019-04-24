<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Show_Main_PageController extends Abstract_PageController
{
    protected $recent_questions;
    protected $parsedown;
    protected $contributors;
    protected $activities;

    protected $hashtags;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];

        $this->recent_questions = (new Questions_Query($this->lang))->findNewestWithAnswer(1, 5);

        // foreach ($this->recent_questions as $question) {
        //     $hashtagsTitles = Hashtag_Extractor_Helper::extractHashtags($question->answer->text);
        //     foreach ($hashtagsTitles as $title) {
        //         $hashtag = Hashtag::initWithTitle($title);
        //         $this->hashtags[$question->id][] = $hashtag;
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
        $this->pageTitle = _('Answeropedia').' - '. _('Ask a question and get one complete answer');
        $this->pageDescription = _('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->canonicalURL = Page_URL_Helper::getMainURL($this->lang);

        $this->openGraph = $this->_getOpenGraph();

        $this->shareLink['title'] = _('Ask a question and get one complete answer').' - '._('Answeropedia');
        $this->shareLink['description'] = _('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.');
        $this->shareLink['url'] = SITE_URL;
        $this->shareLink['image'] = SITE_URL.'/assets/img/og-image.png';

        $this->includeJS[] = 'question/create';
        $this->includeJS[] = 'question/create_from_main';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => SITE_URL,
            'type' => "website",
            'title' => _('Answeropedia').' - '._('Ask a question and get one complete answer'),
            'description' => _('Answeropedia is like Wikipedia, only for questions and answers. You ask a question and get one complete, comprehensive and competent answer from the community.'),
            'locale' => $this->lang,
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }
}
