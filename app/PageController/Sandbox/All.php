<?php

class All_Sandbox_PageController extends Abstract_PageController
{
    const LIST_NEWEST = 'newest';
    const LIST_WITH_ANSWERS = 'with-answers';
    const LIST_WITHOUT_ANSWERS = 'without-answers';

    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];

        $this->list = 'newest';
        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $questionsCount = (new QuestionsCount_Query($this->lang))->questionsLastID();

        $this->questions = (new Questions_Query($this->lang))->findNewest($this->page);

        foreach ($this->questions as $question) {
            if ($question->isRedirect) {
                $redirect = (new Redirects_Query($this->lang))->redirectForQuestionWithID($question->id);
                $this->redirects[$question->id] = $redirect;
            }
        }

        $this->template = 'sandbox';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = $this->_getPageDescription();

        if ($this->questions[9]->id > 1) {
            $this->nextPageURL = Sandbox_URL_Helper::getAllURL($this->lang, ($this->page + 1));
        }

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    #
    # Helper methods
    #

    public function _getPageTitle()
    {
        return _('Sandbox').' - '._('Page').' '.$this->page.' - '._('Answeropedia');
    }

    public function _getPageDescription(): string
    {
        $description = _('Sandbox').' - '._('Page').' '.$this->page.' - '._('Answeropedia');

        return $description;
    }
}
