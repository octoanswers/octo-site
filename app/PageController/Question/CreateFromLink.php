<?php

class CreateFromLink_Question_PageController extends Abstract_PageController
{
    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $questionURI = $args['uri'];
        $this->questionTitle = Question_URL_Helper::titleFromURI($questionURI);

        $this->l = Localizer::getInstance($this->lang);

        try {
            // if question already exists, redirect to question page
            $question = (new Question_Query($this->lang))->questionWithTitle($this->questionTitle);
            if ($question) {
                return $response->withRedirect(Question_URL_Helper::getURL($this->lang, $question), 301);
            }
        } catch (Throwable $e) {
            $question = Question_Model::initWithTitle($this->questionTitle);
        }

        $this->template = 'question/create_from_link';

        $this->pageTitle = $this->l->t('Create question: ').$this->questionTitle.' — '.$this->l->t('octoanswers');
        $this->pageDescription = $this->l->t('page_description');

        $this->additionalJavascript[] = 'question/create';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
