<?php

namespace PageController\Search;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    const LIST_QUESTIONS = 'questions';
    const LIST_CATEGORIES = 'categories';
    const LIST_USERS = 'users';

    const QUESTIONS_PER_PAGE = 10;

    protected $list;
    protected $questions;

    public function handle(Request $request, Response $response, $args)
    {
        $query_params = $request->getQueryParams();

        $this->lang = $args['lang'];

        $this->query = (string) @$query_params['q'];
        $this->list = (string) @$query_params['list'];
        $this->list = $this->_normalize_list($this->list);

        $this->_get_search_results();

        $this->template = 'search';
        $this->pageTitle = __('page_search.page_title') . ': ' . $this->query . ' – ' . __('common.answeropedia');

        $this->searchPlaceholder = $this->_get_search_placeholder($this->list);
        $this->showFooter = false;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    private function _get_search_results(): void
    {
        if ($this->list == self::LIST_CATEGORIES) {
            $this->categories = $this->query ? (new \Query\Search($this->lang))->search_categories($this->query) : [];
        } elseif ($this->list == self::LIST_USERS) {
            $this->users = $this->query ? (new \Query\Search($this->lang))->search_users($this->query) : [];
        } else {
            $this->questions = $this->query ? (new \Query\Search($this->lang))->search_questions($this->query) : [];
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
                $placeholder = __('page_search.placeholder.search_by_questions');
                break;
            case self::LIST_CATEGORIES:
                $placeholder = __('page_search.placeholder.search_by_categories');
                break;
            case self::LIST_USERS:
                $placeholder = __('page_search.placeholder.search_by_contributors');
                break;
            default:
                throw new \Exception('Incorrect list param', 0);
                break;
        }

        return $placeholder;
    }
}
