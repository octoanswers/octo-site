<?php

class Show_Category_PageController extends Abstract_PageController
{
    protected $category_questions;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $categoryURI = $args['uri'];

        try {
            $categoryTitle = urldecode($categoryURI);
            $this->category = (new Category_Query($this->lang))->findWithTitle($categoryTitle);
        } catch (\Exception $e) {
            //return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->parsedown = new ExtendedParsedown($this->lang);

        $humanDateTimezone = new DateTimeZone('UTC');
        $dateHumanizer = new HumanDate($humanDateTimezone, $this->lang);

        $category_questions = (new CategoriesToQuestions_Relations_Query($this->lang))->findNewestForCategoryWithID($this->category->id);
        $this->category_questions = [];

        foreach ($category_questions as $category_question_er) {
            $this->category_questions[] = (new Question_Query($this->lang))->questionWithID($category_question_er->questionID);

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
                'title' => $this->translator->get('More categories'),
                'url' => '#',
            ];
        }

        //$data['alternate_url_prefix'] = $category['url'].'?';

        //$data['most_viewed_writers'] = $this->_getMostViewedWriters();

        if (is_array($this->category_questions)) {
            //    $this->related_categories = $this->_getRelatedCategories($this->category_questions);
        }
        //} else {
        $this->related_categories = [];
        //}

        $this->_prepareFollowButton();

        $this->template = 'category';
        $this->pageTitle = $this->_getPageTitle();
        //str_replace('%category%', , $this->translator->get('Category - Page title')).' • '.$this->translator->get('answeropedia');
        $this->pageDescription = $this->_getPageDescription();
        $this->nextPageURL = null;

        $this->openGraph = $this->_getOpenGraph();
        $this->share = $this->_getOpenGraph();

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _getPageTitle()
    {
        return $this->translator->get('category', 'page_title').' #'.$this->category->title.' · '.$this->translator->get('answeropedia');
    }

    protected function _prepareFollowButton()
    {
        if ($this->authUser) {
            $authUserID = $this->authUser->id;
            $categoryID = $this->category->id;

            $relation = (new UsersFollowCategories_Relations_Query($this->lang))->relationWithUserIDAndCategoryID($authUserID, $categoryID);

            $this->followed = $relation ? true : false;
            $this->includeJS[] = 'category/follow';
        }
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => $this->category->getURL($this->lang),
            'type' => "website",
            'title' => $this->_getPageTitle(),
            'description' => $this->_getPageDescription(),
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }

    protected function _getPageDescription()
    {
        return $this->translator->get('Questions with category').' #'.$this->category->title.' · '.$this->translator->get('answeropedia');
    }

    /**
     * Get most_viewed_writers.
     */
    public function _getMostViewedWriters()
    {
        $most_viewed_writers = [
            [
                'name' => 'Alexander Gomzyakov',
                'url' => 'https://answeropedia.org/user/1/aleksandr-gomzyakov',
                'signature' => 'IT Project Manager',
                'avatar_url' => 'http://placehold.it/48x48',
                'avatar_alt' => 'Answeropedia user',
            ]
        ];

        return $most_viewed_writers;
    }

    public function _getRelatedCategories(array $questions): array
    {
        if (count($questions) == 0) {
            return [];
        }

        $related_titles = [];

        foreach ($questions as $question) {
            // @TODO Now getCategories return Objects
            $categories_titles = $question->getCategories();
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
                $category = Category::initWithTitle($title);
                $related_categories[] = $category;
            }
        } else {
            $related_categories = [];
        }

        return $related_categories;
    }
}
