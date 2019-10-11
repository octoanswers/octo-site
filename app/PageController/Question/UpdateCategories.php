<?php

namespace PageController\Question;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateCategories extends \PageController\PageController
{
    protected $question;

    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];

        $question_ID = $args['id'];

        try {
            $this->question = (new \Query\Question($this->lang))->question_with_ID($question_ID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\InternalServerError($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->categories = (new \Query\Categories($this->lang))->categories_for_question_with_ID($question_ID);

        $this->category_names = [];
        foreach ($this->categories as $category) {
            $this->category_names[] = $category->title;
        }
        $this->categories_string = count($this->category_names) ? implode(',', $this->category_names) : '';

        $this->template = 'question_update_categories';
        $this->pageTitle = __('page_question_update_categories.page.title') . ': ' . $this->question->title . ' - ' . __('common.answeropedia');
        $this->pageDescription = __('page_question_update_categories.page.title') . ': ' . $this->question->title . ' - ' . __('common.answeropedia');
        $this->showFooter = false;

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
