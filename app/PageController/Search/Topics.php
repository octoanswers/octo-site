<?php

class Topics_Search_PageController extends Abstract_PageController
{
    const QUESTIONS_PER_PAGE = 10;

    protected $list;
    protected $questions;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->query = $request->getParam('q');
        $this->list = 'topics';

        // @TODO check query

        if ($this->query) {
            $this->questions = (new Search_Query($this->lang))->searchTopics($this->query);
        }

        $this->template = 'search/topics';
        $this->jumbortonBgStyle = 'red';
        $this->pageTitle = str_replace('%query%', $this->query, _('Search - Page title')).' - '._('OctoAnswers');

        $this->searchPlaceholder = _('Topics - Search input placeholder');

        $searchLinkPostfix = $this->query ? '&q='.$this->query : '';
        $this->searchQuestionsLink = SITE_URL.'/search?list=questions'.$searchLinkPostfix;
        $this->searchTopicsLink = SITE_URL.'/search?list=topics'.$searchLinkPostfix;
        $this->searchUsersLink = SITE_URL.'/search?list=users'.$searchLinkPostfix;

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
