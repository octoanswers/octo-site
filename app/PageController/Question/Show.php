<?php

class Show_Question_PageController extends Abstract_PageController
{
    public $followed;

    // @TODO Deprecated
    public function handleByID($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $questionID = $args['id'];

        try {
            $question = (new Question_Query($this->lang))->questionWithID($questionID);
        } catch (Throwable $e) {
            return (new PageNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($question->getURL($this->lang), 301);
    }

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);
        
        $questionURI = $args['question_uri'];

        try {
            $questionTitle = $this->_titleFromURI($questionURI);
            $this->question = (new Question_Query($this->lang))->questionWithTitle($questionTitle);
        } catch (Throwable $e) {
            return (new QuestionNotFound_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->_tempJobs();

        if ($this->question->isRedirect) {
            $redirect = (new Redirects_Query($this->lang))->redirectForQuestionWithID($this->question->id);
            $this->questionRedirect = Question_Model::initWithTitle($redirect->toTitle);

            $showRedirectPage = $request->getParam('show_rd');
            if (!$showRedirectPage) {
                $redirectTitle = $this->questionRedirect->title;
                $redirectURL = Redirect_URL_Helper::getRedirectURLForTitle($this->lang, $redirectTitle);
                return $response->withRedirect($redirectURL, 301);
            }

            $this->template = 'question/redirect';
            $this->pageTitle = 'Redirect page: '.$this->question->title.' - '.$this->translator->get('answeropedia');

            $output = $this->renderPage();
            $response->getBody()->write($output);

            return $response;
        }

        $redirectedQuestionID = $request->getParam('redirect_from_id') ? (int) $request->getParam('redirect_from_id') : null;
        if ($redirectedQuestionID) {
            $this->redirectedQuestion = (new Question_Query($this->lang))->questionWithID($redirectedQuestionID);

            //.'?redirect_from_id='.$questionID
        }

        if (isset($this->question->answer) && strlen($this->question->answer->text)) {
            // trim first paragraph of answer
            $answer_other_text = preg_replace("/^.+\n/iu", "", $this->question->answer->text);
            $parsedown = new ExtendedParsedown($this->lang);
            $this->formattedAnswerText = trim($parsedown->text($answer_other_text));
        }

        $this->_prepareFollowButton();

        $this->contributors = (new Contributors_Query($this->lang))->findAnswerContributors($this->question->id);

        if (count($this->contributors) > 3) {
            $this->contributors_top = array_slice($this->contributors, 0, 3);
        } else {
            $this->contributors_top = $this->contributors;
        }

        $this->template = 'question';
        $this->htmlAttr = 'itemscope itemtype="http://schema.org/QAPage"';
        $this->bodyAttr = 'itemscope itemtype="http://schema.org/Question"';
        $this->pageTitle = $this->question->title.' - '.$this->translator->get('answeropedia');
        $this->pageDescription = $this->__getPageDescription();
        $this->canonicalURL = $this->question->getURL($this->lang);

        $this->related_questions = $this->_relatedQuestions();

        $this->openGraph = $this->_getOpenGraph();

        $this->shareLink['title'] = $this->question->title;
        $this->shareLink['description'] = $this->translator->get('Wiki-answers to your questions on Answeropedia');
        $this->shareLink['url'] = $this->question->getURL($this->lang);
        $this->shareLink['image'] = SITE_URL.'/assets/img/og-image.png';

        $this->_prepareAdditionalJavascript();
        $this->_prepareModals();

        $output = $this->renderPage();
        $response->getBody()->write($output);
        
        return $response;
    }

    private function _titleFromURI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $uri = str_replace('DOUBLEUNDERLINE', '_', $uri);

        $title = $uri.'?';

        return $title;
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
            $authUserID = $this->authUser->id;
            $question_id = $this->question->id;

            $relation = (new UsersFollowQuestions_Relations_Query($this->lang))->relationWithUserIDAndQuestionID($authUserID, $question_id);

            $this->followed = $relation ? true : false;
        }
    }

    protected function _relatedQuestions(): array
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
                $question = (new Question_Query($this->lang))->questionWithID((int)$key);
                $related_questions[] = $question;
            } catch (\Exception $e) {
                // do nothing
            }
        }

        // FIX bad "a" letter
        try {
            foreach ($related_questions as &$question) {
                $replacedTitle = Question_Replacer_Helper::replaceBadAInTitle($question->title);
                if ($replacedTitle != $question->title) {
                    $question->title = $replacedTitle;
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
            $replacedTitle = Question_Replacer_Helper::replaceBadAInTitle($this->question->title);
            if ($replacedTitle != $this->question->title) {
                $this->question->title = $replacedTitle;
                $this->question = (new Question_Mapper($this->lang))->update($this->question);
            }
        } catch (\Exception $e) {
            // Not critical. Nothing to do.
        }
    }

    protected function __getPageDescription()
    {
        $pageDescription = str_replace('%question%', $this->question->title, $this->translator->get('Wiki-answer on question: %question%'));

        return $pageDescription;
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => $this->question->getURL($this->lang),
            'type' => "website",
            'title' => $this->question->title,
            'description' => $this->__getPageDescription(),
            'locale' => $this->lang,
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }
}
