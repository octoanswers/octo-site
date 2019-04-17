<?php

class Show_Question_PageController extends Abstract_PageController
{
    public $followed;

    // @TODO Deprecated
    public function handleByURI($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $questionURI = $args['question_uri'];

        try {
            $questionTitle = Question_URL_Helper::titleFromURI($questionURI);
            $question = (new Question_Query($this->lang))->questionWithTitle($questionTitle);
        } catch (Throwable $e) {
            return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($question->getURL($this->lang), 301);
    }

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $question_id = $args['id'];
        $question_uri_slug = isset($args['uri_slug']) ? $args['uri_slug'] : null;

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($question_id);
        } catch (Throwable $e) {
            return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->_tempJobs();

        if ($this->question->isRedirect()) {
            $redirect = (new Redirects_Query($this->lang))->redirectForQuestionWithID($this->question->getID());
            $this->questionRedirect = Question_Model::initWithTitle($redirect->toTitle);

            $showRedirectPage = $request->getParam('show_rd');
            if (!$showRedirectPage) {
                $redirectTitle = $this->questionRedirect->getTitle();
                $redirectURL = Redirect_URL_Helper::getRedirectURLForTitle($this->lang, $redirectTitle);
                return $response->withRedirect($redirectURL, 301);
            }

            $this->template = 'question/redirect';
            $this->pageTitle = 'Redirect page: '.$this->question->getTitle().' - '._('Answeropedia');

            $output = $this->renderPage();
            $response->getBody()->write($output);

            return $response;
        }

        if (isset($this->question->answer) && strlen($this->question->answer->text)) {
            // trim first paragraph of answer
            $answer_other_text = preg_replace("/^.+\n/iu", "", $this->question->answer->text);
            $parsedown = new ExtendedParsedown($this->lang);
            $this->formattedAnswerText = trim($parsedown->text($answer_other_text));
        }

        $this->_prepareFollowButton();

        $this->contributors = (new Contributors_Query($this->lang))->findAnswerContributors($this->question->getID());

        if (count($this->contributors) > 3) {
            $this->contributors_top = array_slice($this->contributors, 0, 3);
        } else {
            $this->contributors_top = $this->contributors;
        }

        $this->template = 'question';
        $this->htmlAttr = 'itemscope itemtype="http://schema.org/QAPage"';
        $this->bodyAttr = 'itemscope itemtype="http://schema.org/Question"';
        $this->pageTitle = $this->question->getTitle().' - '._('Answeropedia');
        $this->pageDescription = $this->__getPageDescription();
        $this->canonicalURL = $this->question->getURL($this->lang);

        $this->related_questions = $this->_relatedQuestions();

        $this->openGraph = $this->_getOpenGraph();

        $this->shareLink['title'] = $this->question->getTitle();
        $this->shareLink['description'] = _('Wiki-answers to your questions on Answeropedia');
        $this->shareLink['url'] = $this->question->getURL($this->lang);
        $this->shareLink['image'] = SITE_URL.'/assets/img/og-image.png';

        $this->_prepareAdditionalJavascript();
        $this->_prepareModals();

        $output = $this->renderPage();
        $response->getBody()->write($output);
        
        return $response;
    }

    protected function _prepareAdditionalJavascript()
    {
        if ($this->authUser) {
            $this->includeJS[] = 'question/rename';
            $this->includeJS[] = 'question/upload_image';
            $this->includeJS[] = 'question/follow';
        }
    }

    protected function _prepareModals()
    {
        if ($this->authUser) {
            $this->includeModals[] = 'question/rename';
            $this->includeModals[] = 'question/upload_image';
        }
    }

    protected function _prepareFollowButton()
    {
        if ($this->authUser) {
            $authUserID = $this->authUser->getID();
            $question_id = $this->question->getID();

            $relation = (new UsersFollowQuestions_Relations_Query($this->lang))->relationWithUserIDAndQuestionID($authUserID, $question_id);

            $this->followed = $relation ? true : false;
        }
    }

    protected function _relatedQuestions(): array
    {
        $question_id = $this->question->getID();
        $delta = strlen($this->question->getTitle());
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
                $question = (new Question_Query($this->lang))->questionWithID((int)$key);
                $related_questions[] = $question;
            } catch (\Exception $e) {
                // do nothing
            }
        }

        // FIX bad "a" letter
        try {
            foreach ($related_questions as &$question) {
                $replacedTitle = Question_Replacer_Helper::replaceBadAInTitle($question->getTitle());
                if ($replacedTitle != $question->getTitle()) {
                    $question->setTitle($replacedTitle);
                    $question = (new Question_Mapper($this->lang))->update($question);
                }
            }
        } catch (\Exception $e) {
            // @TODO: depr
        }

        return $related_questions;
    }

    protected function _tempJobs()
    {
        try {
            // FIX bad "a" letter
            $replacedTitle = Question_Replacer_Helper::replaceBadAInTitle($this->question->getTitle());
            if ($replacedTitle != $this->question->getTitle()) {
                $this->question->setTitle($replacedTitle);
                $this->question = (new Question_Mapper($this->lang))->update($this->question);
            }
        } catch (\Exception $e) {
            // Not critical. Nothing to do.
        }
    }

    protected function __getPageDescription()
    {
        $pageDescription = str_replace('%question%', $this->question->getTitle(), _('Wiki-answer on question: %question%'));

        return $pageDescription;
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => $this->question->getURL($this->lang),
            'type' => "website",
            'title' => $this->question->getTitle(),
            'description' => $this->__getPageDescription(),
            'locale' => $this->lang,
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }
}
