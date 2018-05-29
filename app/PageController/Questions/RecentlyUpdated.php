<?php

class RecentlyUpdated_Questions_PageController extends Abstract_PageController
{
    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->l = Localizer::getInstance($this->lang);

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $this->questions_humanizer = new Questions_Humanizer($this->l);
        $this->minutesToRead_humanizer = new MinutesToRead_Humanizer($this->l);

        $this->questions = (new Questions_Query($this->lang))->findRecentlyUpdated($this->page - 1);

        // foreach ($this->questions as $question) {
        //     $contributors_array = (new Contributors_Query($this->lang))->findAnswerContributors($question->getID());
        //     foreach ($contributors_array as $contributor) {
        //         $this->contributors[$question->getID()][] = $contributor;
        //     }
        // }

        $this->template = 'questions/show_list';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = $this->_getPageDescription();
        $this->list = 'recently_updated';

        if (count($this->questions) == self::QUESTIONS_PER_PAGE) {
            $this->nextPageURL = Questions_URL_Helper::getRecentlyUpdatedURL($this->lang, ($this->page + 1));
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
        return $this->l->t('questions', 'recently_updated', 'title').' &middot; '.$this->l->t('questions', 'page_num').' '.$this->page.' &middot; '.$this->l->t('octoanswers');
    }

    public function _getPageDescription(): string
    {
        $postfix = ' (страница '.$this->page.') на сайте '.$this->l->t('octoanswers');
        $description = 'Список вопросы и ответы'.$postfix;

        return $description;
    }
}
