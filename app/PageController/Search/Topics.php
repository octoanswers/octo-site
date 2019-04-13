<?php

class Hashtags_Search_PageController extends Abstract_PageController
{
    const QUESTIONS_PER_PAGE = 10;

    protected $list;
    protected $questions;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->query = $request->getParam('q');
        $this->list = 'hashtags';

        // @TODO check query

        if ($this->query) {
            $this->questions = (new Search_Query($this->lang))->searchHashtags($this->query);
        }

        $this->template = 'search_hashtags';
        $this->jumbortonBgStyle = 'red';
        $this->pageTitle = str_replace('%query%', $this->query, _('Search')).' - '._('Answeropedia');

        $this->searchPlaceholder = _('Search hashtags');

        $searchLinkPostfix = $this->query ? '&q='.$this->query : '';
        $this->searchQuestionsLink = SITE_URL.'/search?list=questions'.$searchLinkPostfix;
        $this->searchHashtagsLink = SITE_URL.'/search?list=hashtags'.$searchLinkPostfix;
        $this->searchUsersLink = SITE_URL.'/search?list=users'.$searchLinkPostfix;

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
