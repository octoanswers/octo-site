<?php

class WithoutHashtags_Sandbox_PageController extends Abstract_PageController
{
    const LIST_NEWEST = 'newest';
    const LIST_WITH_ANSWERS = 'with-answers';
    const LIST_WITHOUT_ANSWERS = 'without-answers';

    const QUESTIONS_PER_PAGE = 10;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];

        $this->page = @$request->getParam('page') ? (int) $request->getParam('page') : 1;

        $questionsCount = (new QuestionsCount_Query($this->lang))->countQuestionsWithoutAnswers();
        $this->humanizedQuestionsCount = $questionsCount.' '.mb_strtolower(ngettext("Question", "Questions", $questionsCount));

        try {
            $this->questions = (new Sandbox_Query($this->lang))->questionsWithoutHashtags($this->page);
        } catch (\Exception $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        // FIX bad "a" letter
        foreach ($this->questions as &$question) {
            $replacedTitle = Question_Replacer_Helper::replaceBadAInTitle($question->getTitle());
            if ($replacedTitle != $question->getTitle()) {
                $question->setTitle($replacedTitle);
                $question = (new Question_Mapper($this->lang))->update($question);
            }
        }

        $this->template = 'sandbox';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = $this->_getPageDescription();
        $this->activeFilter = _('Without answers');

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
        return _('Questions without hashtags').' - '._('Page').' '.$this->page.' - '._('Answeropedia');
    }

    public function _getPageDescription(): string
    {
        $postfix = ' (страница '.$this->page.') на сайте '._('Answeropedia');
        $description = 'Список вопросов без ответов'.$postfix;

        return $description;
    }
}
