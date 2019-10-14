<?php

namespace PageController\Category;

class Show extends \PageController\PageController
{
    public function handle($request, $response, $args)
    {
        $query_params = $request->getQueryParams();

        $this->lang = $args['lang'];
        $this->page = @$query_params['page'] ? (int) $query_params['page'] : 1;

        $category_URI = $args['category_uri'];

        try {
            $category_title = $this->_category_title_from_URI($category_URI);
            $this->category = (new \Query\Category($this->lang))->categoryWithTitle($category_title);
        } catch (\Exception $e) {
            return (new \PageController\Error\CategoryNotFound($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->questions = $this->_get_questions();

        if (is_array($this->questions) && count($this->questions) == 10) {
            $data['next_page_button'] = [
                'title' => __('page_category.more_categories'),
                'url'   => '#',
            ];
        }

        //$data['most_viewed_writers'] = $this->_get_most_viewed_writers();

        $this->related_categories = [];

        $this->_prepare_follow_button();
        $this->_prepare_additional_JS();
        $this->_prepare_modals();

        $this->template = 'category';
        $this->pageTitle = $this->_get_page_title();
        $this->pageDescription = $this->_get_page_description();
        $this->nextPageURL = null;

        $this->open_graph = $this->_get_open_graph();

        $this->share_link['title'] = $this->_get_page_title();
        $this->share_link['description'] = $this->_get_page_description();
        $this->share_link['url'] = $this->category->getURL($this->lang);
        $this->share_link['image'] = SITE_URL . '/assets/img/og-image.png';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _get_page_title()
    {
        return __('page_category.page_title') . $this->category->title . ' – ' . __('common.answeropedia');
    }

    protected function _prepare_follow_button()
    {
        if ($this->authUser) {
            $authUserID = $this->authUser->id;
            $categoryID = $this->category->id;

            $relation = (new \Query\Relations\UsersFollowCategories($this->lang))->relationWithUserIDAndCategoryID($authUserID, $categoryID);

            $this->followed = $relation ? true : false;
        }
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => $this->category->getURL($this->lang),
            'type'        => 'website',
            'title'       => $this->_get_page_title(),
            'description' => $this->_get_page_description(),
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }

    protected function _get_page_description()
    {
        return __('page_category.questions_with_category') . ' ' . $this->category->title . ' – ' . __('common.answeropedia');
    }

    private function _category_title_from_URI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $title = str_replace('DOUBLEUNDERLINE', '_', $uri);

        return $title;
    }

    protected function _get_questions(): array
    {
        $top_questions = [];

        $category_question_relations = (new \Query\Relations\CategoriesToQuestions($this->lang))->findNewestForCategoryWithID($this->category->id, $this->page);

        foreach ($category_question_relations as $category_question_er) {
            $question = (new \Query\Question($this->lang))->questionWithID($category_question_er->questionID);

            $contributors = (new \Query\Contributors($this->lang))->findAnswerContributors($question->id);

            $categories = (new \Query\Categories($this->lang))->categoriesForQuestionWithID($question->id);
            if (count($categories) > 2) {
                $categories = array_slice($categories, 0, 2);
            }

            $top_questions[] = [
                'question'         => $question,
                'categories'       => $categories,
                'contributors'     => $contributors,
            ];
        }

        return $top_questions;
    }

    public function _get_most_viewed_writers()
    {
        $most_viewed_writers = [
            [
                'name'       => 'Alexander Gomzyakov',
                'url'        => 'https://answeropedia.org/user/1/aleksandr-gomzyakov',
                'signature'  => 'IT Project Manager',
                'avatar_url' => 'http://placehold.it/48x48',
                'avatar_alt' => 'Answeropedia user',
            ],
        ];

        return $most_viewed_writers;
    }

    public function _get_related_categories(array $questions): array
    {
        if (count($questions) == 0) {
            return [];
        }

        $related_titles = [];

        foreach ($questions as $question) {
            // @TODO Now this code incorrect
            $categories_titles = []; //$question->getCategories();
            if (is_array($categories_titles) && count($categories_titles)) {
                foreach ($categories_titles as $title) {
                    //@TODO need a query
                    $related_titles[] = $title;
                }
            }
        }

        //$related_titles = array_unique($related_titles);
        $related_titles = array_reverse($related_titles);

        $del_val = $this->category->title;
        if (($key = array_search($del_val, $related_titles)) !== false) {
            unset($related_titles[$key]);
        }

        $related_categories = [];
        if (count($related_titles)) {
            foreach ($related_titles as $title) {
                $category = \Model\Category::initWithTitle($title);
                $related_categories[] = $category;
            }
        } else {
            $related_categories = [];
        }

        return $related_categories;
    }

    protected function _prepare_additional_JS()
    {
        if ($this->authUser) {
            $this->includeJS[] = 'category/rename';
            $this->includeJS[] = 'category/follow';
        }
    }

    protected function _prepare_modals()
    {
        if ($this->authUser) {
            $this->includeModals[] = 'category/rename';
        }
    }
}
