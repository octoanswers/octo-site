<?php

class WithoutHashtags_Sandbox_PageController extends Abstract_PageController
{
    const LIST_NEWEST = 'newest';
    const LIST_WITH_ANSWERS = 'with-answers';
    const LIST_WITHOUT_ANSWERS = 'without-answers';

    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        try {
            $this->questions = (new Sandbox_Query($this->lang))->questionsWithoutHashtags($this->page);
        } catch (\Exception $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        // FIX bad "a" letter
        foreach ($this->questions as &$question) {
            $replacedTitle = Question_Replacer_Helper::replaceBadAInTitle($question->title);
            if ($replacedTitle != $question->title) {
                $question->title = $replacedTitle;
                $question = (new Question_Mapper($this->lang))->update($question);
            }
        }

        $this->template = 'sandbox';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = $this->_getPageDescription();
        $this->activeFilter = $this->translator->get('Without answers');

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = Sandbox_URL_Helper::getWithoutAnswersURL($this->lang, ($this->page + 1));
        }

        $this->list = 'without_hashtags';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    #
    # Helper methods
    #

    public function _getPageTitle()
    {
        return $this->translator->get('Questions without hashtags').' · '.$this->translator->get('page').' '.$this->page.' · '.$this->translator->get('answeropedia');
    }

    public function _getPageDescription(): string
    {
        $description = $this->translator->get('Questions without hashtags').' · '.$this->translator->get('page').' '.$this->page.' · '.$this->translator->get('answeropedia');

        return $description;
    }
}
