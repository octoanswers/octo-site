<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateCategories_Question_PageController extends Abstract_PageController
{
    protected $question;

    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        $question_ID = $args['id'];

        try {
            $this->question = (new Question_Query($this->lang))->question_with_ID($question_ID);
        } catch (Throwable $e) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->categories = (new Categories_Query($this->lang))->categories_for_question_with_ID($question_ID);

        $this->category_names = [];
        foreach ($this->categories as $category) {
            $this->category_names[] = $category->title;
        }
        $this->categories_string = count($this->category_names) ? implode(',', $this->category_names) : '';

        $this->template = 'question_update_categories';
        $this->pageTitle = str_replace('%question%', $this->question->title, $this->translator->get('Update categories for question "%question%" - Answeropedia'));
        $this->pageDescription = str_replace('%question%', $this->question->title, $this->translator->get('Update categories for question "%question%"'));

        $this->includeJS[] = SITE_URL . '/assets/_vendor/Nodws/bootstrap4-tagsinput/tagsinput.js';
        $this->includeJS[] = SITE_URL . '/assets/_vendor/twitter/typeahead.js/bloodhound.js';
        $this->includeJS[] = SITE_URL . '/assets/_vendor/twitter/typeahead.js/typeahead.bundle.min.js';
        $this->includeJS[] = 'question/tagsinput';
        $this->includeJS[] = 'question/update_topics';

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
