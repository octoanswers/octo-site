<?php

class Newest_Questions_PageController extends Abstract_PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $questionsCount = (new QuestionsCount_Query($this->lang))->questionsLastID();

        $this->questions = (new Questions_Query($this->lang))->findNewestWithAnswer($this->page);

        foreach ($this->questions as $question) {
            $contributors_array = (new Contributors_Query($this->lang))->findAnswerContributors($question->getID());
            foreach ($contributors_array as $contributor) {
                $this->contributors[$question->getID()][] = $contributor;
            }
        }

        $this->template = 'questions';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = $this->_getPageDescription();
        $this->list = 'with-answers';

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = Questions_URL_Helper::getNewestURL($this->lang, ($this->page + 1));
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
        return _('Newest questions').' - '._('Page').' '.$this->page.' - '._('Answeropedia');
    }

    public function _getPageDescription(): string
    {
        $description = _('Newest questions').' - '._('Page').' '.$this->page.' - '._('Answeropedia');

        return $description;
    }
}
