<?php

class Newest_Questions_PageController extends Abstract_PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $questionsCount = (new QuestionsCount_Query($this->lang))->questionsLastID();

        $this->questions = (new Questions_Query($this->lang))->findNewestWithAnswer($this->page);

        foreach ($this->questions as $question) {
            $contributors_array = (new Contributors_Query($this->lang))->findAnswerContributors($question->id);
            foreach ($contributors_array as $contributor) {
                $this->contributors[$question->id][] = $contributor;
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
        return $this->translator->get('Newest questions').' · '.$this->translator->get('page').' '.$this->page.' · '.$this->translator->get('answeropedia');
    }

    public function _getPageDescription(): string
    {
        $description = $this->translator->get('Newest questions').' · '.$this->translator->get('page').' '.$this->page.' · '.$this->translator->get('answeropedia');

        return $description;
    }
}
