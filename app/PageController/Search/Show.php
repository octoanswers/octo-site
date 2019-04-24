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
        $this->lang = (string) $args['lang'];
        $this->query = (string) $request->getParam('q');

        $this->list = $request->getParam('list');
        $this->list = $this->_normalizeList($this->list);
        
        $this->_getSearchResults();

        $this->template = 'search';
        $this->pageTitle = str_replace('%query%', $this->query, _('Search %query% - Answeropedia'));

        $this->searchPlaceholder = $this->_getSearchPlaceholder($this->list);
        $this->showFooter = false;

        $searchLinkPostfix = $this->query ? '&q='.$this->query : '';
        $this->searchQuestionsLink = SITE_URL.'/'.$this->lang.'/search?list=questions'.$searchLinkPostfix;
        $this->searchHashtagsLink = SITE_URL.'/'.$this->lang.'/search?list=hashtags'.$searchLinkPostfix;
        $this->searchUsersLink = SITE_URL.'/'.$this->lang.'/search?list=users'.$searchLinkPostfix;

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    private function _getSearchResults(): void
    {
        if ($this->list == self::LIST_HASHTAGS) {
            $this->hashtags = $this->query ? (new Search_Query($this->lang))->searchHashtags($this->query) : [];
        } elseif ($this->list == self::LIST_USERS) {
            $this->users = $this->query ? (new Search_Query($this->lang))->searchUsers($this->query) : [];
        } else {
            $this->questions = $this->query ? (new Search_Query($this->lang))->searchQuestions($this->query) : [];
        }
    }

    private function _normalizeList($list): string
    {
        if ($list == self::LIST_HASHTAGS || $list == self::LIST_USERS) {
            return $list;
        }

        return self::LIST_QUESTIONS;
    }

    private function _getSearchPlaceholder(string $list): string
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
