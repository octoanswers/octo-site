<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UpdateTopics_Question_PageController extends Abstract_PageController
{
    protected $question;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];
        $this->l = Localizer::getInstance($this->lang);

        $questionID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($questionID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->topics_string = $this->question->getTopics() ? implode(", ", $this->question->getTopics()) : '';

        $this->template = 'question/update_topics';
        $this->pageTitle = $this->_getPageTitle();
        $this->pageDescription = $this->l->t('XXpage_description');
        $this->additionalJavascript[] = 'question/update_topics';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    private function _getPageTitle()
    {
        return $this->l->t('XXXquestion_rename__page_title').': '.$this->question->getTitle().' - '._('OctoAnswers');
    }
}
