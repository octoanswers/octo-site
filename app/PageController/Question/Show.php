<?php

class Show_Question_PageController extends Abstract_PageController
{
    public $followed;
    public $firstTwoCategories = [];

    // @TODO Deprecated
    public function handleByID($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $questionID = $args['id'];

        try {
            $question = (new \Query\Question($this->lang))->question_with_ID($questionID);
        } catch (Throwable $e) {
            return (new PageNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($question->get_URL($this->lang), 301);
    }

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $question_URI = $args['question_uri'];

        try {
            $question_title = \Helper\Title::title_from_question_URI($question_URI);
            $this->question = (new \Query\Question($this->lang))->question_with_title($question_title);
        } catch (Throwable $e) {
            return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        if ($this->question->isRedirect) {
            $redirect = (new \Query\Redirects\Question($this->lang))->redirect_for_question_with_ID($this->question->id);
            $this->questionRedirect = \Model\Question::init_with_title($redirect->toTitle);

            $need_stop_redirect = $request->getParam('no_redirect');
            if (!$need_stop_redirect) {
                $redirectTitle = $this->questionRedirect->title;
                $redirectURL = \Helper\URL\Redirect::get_redirect_URL_for_title($this->lang, $redirectTitle) . '?redirect_from_id=' . $this->question->id;

                return $response->withRedirect($redirectURL, 301);
            }

            $this->template = 'question_redirect';
            $this->pageTitle = 'Redirect page: ' . $this->question->title . ' – ' . $this->translator->get('answeropedia');

            $output = $this->render_page();
            $response->getBody()->write($output);

            return $response;
        }

        $redirected_question_ID = $request->getParam('redirect_from_id') ? (int) $request->getParam('redirect_from_id') : null;
        if ($redirected_question_ID) {
            $this->redirectedQuestion = (new \Query\Question($this->lang))->question_with_ID($redirected_question_ID);
        }

        if (isset($this->question->answer) && strlen($this->question->answer->text)) {
            $parsedown = new \Helper\ExtendedParsedown($this->lang);
            $this->formattedAnswerText = $parsedown->text($this->question->answer->text);
        }

        $this->_prepare_follow_button();

        $this->contributors = (new \Query\Contributors($this->lang))->find_answer_contributors($this->question->id);

        if (count($this->contributors) > 3) {
            $this->contributors_top = array_slice($this->contributors, 0, 3);
        } else {
            $this->contributors_top = $this->contributors;
        }

        $this->categories = (new \Query\Categories($this->lang))->categories_for_question_with_ID($this->question->id);

        if (count($this->categories)) {
            if (count($this->categories) > 2) {
                $this->firstTwoCategories = array_slice($this->categories, 0, 2);
            } else {
                $this->firstTwoCategories = $this->categories;
            }
        }

        $this->template = 'question';
        $this->htmlAttr = 'itemscope itemtype="http://schema.org/QAPage"';
        $this->bodyAttr = 'itemscope itemtype="http://schema.org/Question"';
        $this->pageTitle = $this->question->title . ' – ' . $this->translator->get('answeropedia');
        $this->pageDescription = $this->_get_page_description();
        $this->canonicalURL = $this->question->get_URL($this->lang);

        $this->related_questions = $this->_related_questions();

        $this->open_graph = $this->_get_open_graph();

        $this->share_link['title'] = $this->question->title;
        $this->share_link['description'] = $this->translator->get('question', 'share_link__description');
        $this->share_link['url'] = $this->question->get_URL($this->lang);
        $this->share_link['image'] = SITE_URL . '/assets/img/og-image.png';

        $this->_prepare_additional_JS();
        $this->_prepare_modals();

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _prepare_additional_JS()
    {
        if ($this->authUser) {
            $this->includeJS[] = 'question/rename';
            $this->includeJS[] = 'question/upload_image';
            $this->includeJS[] = 'question/follow';
        }
    }

    protected function _prepare_modals()
    {
        if ($this->authUser) {
            $this->includeModals[] = 'question/rename';
            $this->includeModals[] = 'question/upload_image';
        }
    }

    protected function _prepare_follow_button()
    {
        if ($this->authUser) {
            $authUserID = $this->authUser->id;
            $question_id = $this->question->id;

            $relation = (new \Query\Relations\UsersFollowQuestions($this->lang))->relation_with_user_ID_and_question_ID($authUserID, $question_id);

            $this->followed = $relation ? true : false;
        }
    }

    protected function _related_questions(): array
    {
        $question_id = $this->question->id;
        $delta = strlen($this->question->title);
        $related_questions = [];

        $keys = [];
        for ($i = 2; $i < 6; $i++) {
            $key = $question_id - ($i * $delta);
            if ($key < 1) {
                $key = $i * $delta;
            }
            $keys[] = $key;
        }

        foreach ($keys as $key) {
            try {
                $question = (new \Query\Question($this->lang))->question_with_ID((int) $key);
                $related_questions[] = $question;
            } catch (\Exception $e) {
                // do nothing
            }
        }

        return $related_questions;
    }

    protected function _get_page_description()
    {
        $page_description = str_replace('%question%', $this->question->title, $this->translator->get('question', 'page_description'));

        return $page_description;
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => $this->question->get_URL($this->lang),
            'type'        => 'website',
            'title'       => $this->question->title,
            'description' => $this->_get_page_description(),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }
}
