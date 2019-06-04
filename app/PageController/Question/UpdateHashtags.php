<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UpdateCategories_Question_PageController extends Abstract_PageController
{
    protected $question;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $questionID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->questionWithID($questionID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $titlesArray = [];
        foreach ($this->question->getCategories() as $category) {
            $titlesArray[] = $category->title;
        }
        
        $this->categories_string = $this->question->getCategories() ? implode(", ", $titlesArray) : '';

        $this->template = 'question_update_categories';
        $this->pageTitle = str_replace("%question%", $this->question->title, $this->translator->get('Update categories for question "%question%" - Answeropedia'));
        $this->pageDescription = str_replace("%question%", $this->question->title, $this->translator->get('Update categories for question "%question%"'));

        $this->includeCSS[] = SITE_URL.'/assets/_vendor/Nodws/bootstrap4-tagsinput/tagsinput.css';

        $this->includeJS[] = SITE_URL.'/assets/_vendor/Nodws/bootstrap4-tagsinput/tagsinput.js';
        $this->includeJS[] = SITE_URL.'/assets/_vendor/twitter/typeahead.js/bloodhound.js';
        $this->includeJS[] = SITE_URL.'/assets/_vendor/twitter/typeahead.js/typeahead.bundle.min.js';
        $this->includeJS[] = 'question/tagsinput';
        $this->includeJS[] = 'question/update_topics';

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
