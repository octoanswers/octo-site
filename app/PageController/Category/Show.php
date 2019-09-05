<?php

class Show_Category_PageController extends Abstract_PageController
{
    protected $category_questions;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $category_URI = $args['category_uri'];

        try {
            $category_title = $this->_category_title_from_URI($category_URI);
            $this->category = (new Category_Query($this->lang))->category_with_title($category_title);
        } catch (\Exception $e) {
            return (new CategoryNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->parsedown = new ExtendedParsedown($this->lang);

        $human_date_time_zone = new DateTimeZone('UTC');
        $date_humanizer = new HumanDate($human_date_time_zone, $this->lang);

        $category_questions = (new CategoriesToQuestions_Relations_Query($this->lang))->find_newest_for_category_with_ID($this->category->id);
        $this->category_questions = [];

        foreach ($category_questions as $category_question_er) {
            $this->category_questions[] = (new Question_Query($this->lang))->question_with_ID($category_question_er->questionID);

            //$question['date_humanized'] = $dateHumanizer->format($question->createdAt);
        }

        // recount questions count if GET-param on 20% random
        try {
            // if ((mt_rand(0, 10) > 7) || isset($_GET['upd'])) {
            //     $questionsCount = api_v1_get_categories_ID_questions_count($args['category_id']);
            //     $category->setQuestionsCount($questionsCount);
            //     $categoryMapper = new CategoryMapper($pdo);
            //     $categoryMapper->saveCategory($category);
            // }
        } catch (Throwable $e) {
            // do nothing
        }

        if (is_array($this->category_questions) && count($this->category_questions) == 10) {
            $data['next_page_button'] = [
                'title' => $this->translator->get('category', 'more_categories'),
                'url'   => '#',
            ];
        }

        //$data['alternate_url_prefix'] = $category['url'].'?';

        //$data['most_viewed_writers'] = $this->_get_most_viewed_writers();

        if (is_array($this->category_questions)) {
            //    $this->related_categories = $this->_get_related_categories($this->category_questions);
        }
        //} else {
        $this->related_categories = [];
        //}

        $this->_prepare_follow_button();
        $this->_prepare_additional_JS();
        $this->_prepare_modals();

        $this->template = 'category';
        $this->pageTitle = $this->_get_page_title();
        //str_replace('%category%', , $this->translator->get('Category - Page title')).' • '.$this->translator->get('answeropedia');
        $this->pageDescription = $this->_get_page_description();
        $this->nextPageURL = null;

        $this->open_graph = $this->_get_open_graph();
        $this->share = $this->_get_open_graph();

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _get_page_title()
    {
        return $this->translator->get('category', 'page_title') . $this->category->title . ' – ' . $this->translator->get('answeropedia');
    }

    protected function _prepare_follow_button()
    {
        if ($this->authUser) {
            $authUserID = $this->authUser->id;
            $categoryID = $this->category->id;

            $relation = (new UsersFollowCategories_Relations_Query($this->lang))->relation_with_user_ID_and_category_ID($authUserID, $categoryID);

            $this->followed = $relation ? true : false;
        }
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => $this->category->get_URL($this->lang),
            'type'        => 'website',
            'title'       => $this->_get_page_title(),
            'description' => $this->_get_page_description(),
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }

    protected function _get_page_description()
    {
        return $this->translator->get('category', 'questions_with_category') . ' ' . $this->category->title . ' – ' . $this->translator->get('answeropedia');
    }

    private function _category_title_from_URI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $title = str_replace('DOUBLEUNDERLINE', '_', $uri);

        return $title;
    }

    /**
     * Get most_viewed_writers.
     */
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
                $category = Category_Model::init_with_title($title);
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
