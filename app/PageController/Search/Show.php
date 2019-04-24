<?php

class Show_Search_PageController extends Abstract_PageController
{
    const LIST_QUESTIONS = 'questions';
    const LIST_HASHTAGS = 'hashtags';
    const LIST_USERS = 'users';

    const QUESTIONS_PER_PAGE = 10;

    protected $list;
    protected $questions;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->query = $request->getParam('q');

        $this->list = $request->getParam('list');
        $this->list = ($this->list != self::LIST_QUESTIONS || $this->list != self::LIST_HASHTAGS || $this->list != self::LIST_USERS) ? self::LIST_QUESTIONS : $this->list ;

        // @TODO check query

        if ($this->query) {
            $this->questions = (new Search_Query($this->lang))->searchQuestions($this->query);
        } else {
            $this->questions = [];
        }

        $this->template = 'search';
        $this->pageTitle = str_replace('%query%', $this->query, _('Search %query% - Answeropedia'));

        $this->searchPlaceholder = $this->_getSearchPlaceholder($this->list);
        $this->showFooter = false;
        
        $searchLinkPostfix = $this->query ? '&q='.$this->query : '';
        $this->searchQuestionsLink = SITE_URL.'/search?list=questions'.$searchLinkPostfix;
        $this->searchHashtagsLink = SITE_URL.'/search?list=hashtags'.$searchLinkPostfix;
        $this->searchUsersLink = SITE_URL.'/search?list=users'.$searchLinkPostfix;

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    #
    # Helper methods
    #

    public function _getSearchPlaceholder(string $list): string
    {
        switch ($list) {
            case self::LIST_QUESTIONS:
                $placeholder = _('Search by questions');
                break;
            case self::LIST_HASHTAGS:
                $placeholder = _('Search by hashtags');
                break;
            case self::LIST_USERS:
                $placeholder = _('Search by contributors');
                break;
            default:
                throw new Exception("Incorrect list param", 0);
                break;
        }
        return $placeholder;
    }
}
