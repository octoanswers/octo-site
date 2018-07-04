<?php

class Show_Question_PageController extends Abstract_PageController
{
    // @TODO Deprecated
    public function handleByURI($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $questionURI = $args['question_uri'];

        $this->l = Localizer::getInstance($this->lang);

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
        $question_uri_slug = $args['uri_slug'];

        $this->l = Localizer::getInstance($this->lang);

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($question_id);
        } catch (Throwable $e) {
            return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->_tempJobs();

        if ($this->question->isRedirect()) {
            $redirect = (new Redirects_Query($this->lang))->redirectForQuestionWithID($this->question->getID());
            $this->questionRedirect = Question_Model::initWithTitle($redirect->getRedirectTitle());

            $showRedirectPage = $request->getParam('show_rd');
            if (!$showRedirectPage) {
                $redirectTitle = $this->questionRedirect->getTitle();
                $redirectURL = Redirect_URL_Helper::getRedirectURLForTitle($this->lang, $redirectTitle);
                return $response->withRedirect($redirectURL, 301);
            }

            $this->template = 'question/redirect';
            $this->pageTitle = 'Redirect page: '.$this->question->getTitle().' - '.$this->l->t('octoanswers');

            $output = $this->renderPage();
            $response->getBody()->write($output);

            return $response;
        }

        $this->answer = $this->question->getAnswer();

        if (strlen($this->answer->getText())) {
            // trim first paragraph of answer
            $answer_other_text = preg_replace("/^.+\n/iu", "", $this->answer->getText());
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

        if (count($this->contributors)) {
            $this->lastContributorID = end($this->contributors)->getID();
            $this->maxContribution = $this->contributors[0]->getContribution();
        }

        $this->template = 'question/show';
        $this->pageTitle = $this->question->getTitle().' - '.$this->l->t('octoanswers');
        $this->pageDescription = $this->__getPageDescription();
        $this->canonicalURL = $this->question->getURL($this->lang);

        $this->related_questions = $this->_related_questions();

        $questions_with_image_offset = $this->question->getID();

        if ($this->question->getImageBaseName()) {
            $this->questions_with_image = (new Questions_Query($this->lang))->findQuestionsWithImage($questions_with_image_offset);
        }

        $this->openGraph = $this->_getOpenGraph();

        $this->shareLink['title'] = $this->question->getTitle();
        $this->shareLink['description'] = $this->l->t('q_pg__share_description');
        $this->shareLink['url'] = $this->question->getURL($this->lang);
        $this->shareLink['image'] = SITE_URL.'/assets/img/og-image.png';

        $this->_prepareAdditionalJavascript();

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _prepareAdditionalJavascript()
    {
        if (!$this->answer->getText() && !$this->authUser) {
            $this->additionalJavascript[] = 'question/subscribe';
        }

        if ($this->authUser) {
            $this->additionalJavascript[] = 'question/rename';
            $this->additionalJavascript[] = 'question/upload_image';
        }
    }

    protected function _prepareFollowButton()
    {
        if ($this->authUser) {
            $authUserID = $this->authUser->getID();
            $question_id = $this->question->getID();

            $relation = (new UsersFollowQuestions_Relations_Query($this->lang))->relationWithUserIDAndQuestionID($authUserID, $question_id);;

            $this->followed = $relation ? true : false;
            $this->additionalJavascript[] = 'question/follow';
        }
    }

    protected function _related_questions(): array
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
        $pageDescription = str_replace('%question%', $this->question->getTitle(), $this->l->t('q_pg__page_description'));

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
