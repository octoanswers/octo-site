<?php

class Show_Topic_PageController extends Abstract_PageController
{
    protected $topic_questions;

    // @TODO Deprecated
    public function handleByURI($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $topic_uri = $args['uri'];

        try {
            $topic_title = Topic_URL_Helper::titleFromURI($topic_uri);
            $this->topic = (new Topic_Query($this->lang))->findWithTitle($topic_title);
            if ($this->topic === null) {
                throw new \Exception("Topic not exists", 1);
            }
        } catch (\Exception $e) {
            //return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($this->topic->getURL($this->lang), 301);
    }

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $topic_id = $args['id'];
        $topic_uri_slug = $args['uri_slug'];

        try {
            $this->topic = (new Topic_Query($this->lang))->topicWithID($topic_id);
        } catch (\Exception $e) {
            //return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->parsedown = new ExtendedParsedown($this->lang);

        $humanDateTimezone = new DateTimeZone('UTC');
        $dateHumanizer = new HumanDate($humanDateTimezone, $this->lang);

        $topic_questions = (new TopicsToQuestions_Relations_Query($this->lang))->findNewestForTopicWithID($this->topic->getID());
        $this->topic_questions = [];

        foreach ($topic_questions as $topic_question_er) {
            $this->topic_questions[] = (new Question_Query($this->lang))->questionWithID($topic_question_er->getQuestionID());

            //$question['date_humanized'] = $dateHumanizer->format($question->getCreatedAt());
        }

        // recount questions count if GET-param on 20% random
        try {
            // if ((mt_rand(0, 10) > 7) || isset($_GET['upd'])) {
            //     $questionsCount = api_v1_get_topics_ID_questions_count($args['topic_id']);
            //     $topic->setQuestionsCount($questionsCount);
            //     $topicMapper = new CategoryMapper($pdo);
            //     $topicMapper->saveTopic($topic);
            // }
        } catch (Throwable $e) {
            // do nothing
        }

        if (is_array($this->topic_questions) && count($this->topic_questions) == 10) {
            $data['next_page_button'] = [
                'title' => _('More topics'),
                'url' => '#',
            ];
        }

        //$data['alternate_url_prefix'] = $topic['url'].'?';

        //$data['most_viewed_writers'] = $this->_getMostViewedWriters();

        if (is_array($this->topic_questions)) {
            $this->related_topics = $this->_getRelatedTopics($this->topic_questions);
        }
        //} else {
        //  $this->related_topics = [];
        //}

        $this->_prepareFollowButton();

        $this->template = 'topic';
        $this->pageTitle = $this->_getPageTitle();
        //str_replace('%topic%', , _('Topic - Page title')).' • '._('Answeropedia');
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
        return str_replace('%topic%', $this->topic->getTitle(), _('Questions and answers on the topic %topic% - Answeropedia'));
    }

    protected function _prepareFollowButton()
    {
        if ($this->authUser) {
            $authUserID = $this->authUser->getID();
            $topicID = $this->topic->getID();

            $relation = (new UsersFollowTopics_Relations_Query($this->lang))->relationWithUserIDAndTopicID($authUserID, $topicID);

            $this->followed = $relation ? true : false;
            $this->includeJS[] = 'topic/follow';
        }
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => $this->topic->getURL($this->lang),
            'type' => "website",
            'title' => $this->_getPageTitle(),
            'description' => $this->_getPageDescription(),
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }

    protected function _getPageDescription()
    {
        return str_replace('%topic%', $this->topic->getTitle(), _('Questions and answers on the topic %topic%'));
    }

    /**
     * Get most_viewed_writers.
     */
    public function _getMostViewedWriters()
    {
        $most_viewed_writers = [
            [
                'name' => 'Александр Гомзяков',
                'url' => 'https://answeropedia.org/user/1/aleksandr-gomzyakov',
                'signature' => 'Менеджер ИТ-проектов, answeropedia.org',
                'avatar_url' => 'http://placehold.it/48x48',
                'avatar_alt' => 'Александр Гомзяков',
            ],
            [
                'name' => 'Виктор Белохвостов',
                'url' => 'https://answeropedia.org/user/13/viktor-belohvostov',
                'signature' => 'Менеджер, продавец корпоративных услуг в области ИТ',
                'avatar_url' => 'http://placehold.it/48x48',
                'avatar_alt' => 'Виктор Белохвостов',
            ],
            [
                'name' => 'Александр Гомзяков',
                'url' => 'https://answeropedia.org/user/1/aleksandr-gomzyakov',
                'signature' => 'Менеджер ИТ-проектов, answeropedia.org',
                'avatar_url' => 'http://placehold.it/48x48',
                'avatar_alt' => 'Александр Гомзяков',
            ],
        ];

        return $most_viewed_writers;
    }

    public function _getRelatedTopics(array $questions): array
    {
        if (count($questions) == 0) {
            return [];
        }

        $related_titles = [];

        foreach ($questions as $question) {
            $topics_titles = $question->getTopics();
            if (is_array($topics_titles) && count($topics_titles)) {
                foreach ($topics_titles as $title) {
                    //@TODO need a query
                    $related_titles[] = $title;
                }
            }
        }

        $related_titles = array_unique($related_titles);
        $related_titles = array_reverse($related_titles);

        $del_val = $this->topic->getTitle();
        if (($key = array_search($del_val, $related_titles)) !== false) {
            unset($related_titles[$key]);
        }

        $related_topics = [];
        if (count($related_titles)) {
            foreach ($related_titles as $title) {
                $topic = Topic_Model::initWithTitle($title);
                $related_topics[] = $topic;
            }
        } else {
            $related_topics = [];
        }

        return $related_topics;
    }
}
