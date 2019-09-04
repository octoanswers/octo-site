<?php

class Show_Search_PageController extends Abstract_PageController
{
    const LIST_QUESTIONS = 'questions';
    const LIST_CATEGORIES = 'categories';
    const LIST_USERS = 'users';

    const QUESTIONS_PER_PAGE = 10;

    protected $list;
    protected $questions;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->query = (string) $request->getParam('q');

        $this->list = (string) $request->getParam('list');
        $this->list = $this->_normalize_list($this->list);

        $this->_get_search_results();

        $this->template = 'search';
        $this->pageTitle = $this->translator->get('search', 'page_title') . ': ' . $this->query . ' – ' . $this->translator->get('answeropedia');

        $this->searchPlaceholder = $this->_get_search_placeholder($this->list);
        $this->showFooter = false;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    private function _get_search_results(): void
    {
        if ($this->list == self::LIST_CATEGORIES) {
            $this->categories = $this->query ? (new Search_Query($this->lang))->search_categories($this->query) : [];
        } elseif ($this->list == self::LIST_USERS) {
            $this->users = $this->query ? (new Search_Query($this->lang))->search_users($this->query) : [];
        } else {
            $this->questions = $this->query ? (new Search_Query($this->lang))->search_questions($this->query) : [];
        }
    }

    private function _normalize_list(string $list): string
    {
        if ($list == self::LIST_CATEGORIES || $list == self::LIST_USERS) {
            return $list;
        }

        return self::LIST_QUESTIONS;
    }

    private function _get_search_placeholder(string $list): string
    {
        switch ($list) {
            case self::LIST_QUESTIONS:
                $placeholder = $this->translator->get('Search by questions');
                break;
            case self::LIST_CATEGORIES:
                $placeholder = $this->translator->get('Search by categories');
                break;
            case self::LIST_USERS:
                $placeholder = $this->translator->get('Search by contributors');
                break;
            default:
                throw new Exception('Incorrect list param', 0);
                break;
        }

        return $placeholder;
    }
}
