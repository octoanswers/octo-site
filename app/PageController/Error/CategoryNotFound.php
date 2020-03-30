<?php

namespace PageController\Error;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoryNotFound extends \PageController\PageController
{
    public function handle(Request $request, Response $response): Response
    {
        $lang = $request->getAttribute('lang');
        $category_URI = $request->getAttribute('category_uri');

        $this->lang = $lang;

        $this->categoryTitle = $this->_category_title_from_URI($category_URI);

        $category = new \Model\Category();
        $category->title = $this->categoryTitle;

        $this->template = 'error/category_not_found';
        $this->showFooter = false;
        $this->pageTitle = __('page_error.category_not_found.page_title').$this->categoryTitle.' – '.__('common.answeropedia');
        $this->pageDescription = __('page_error.category_not_found.page_title').$this->categoryTitle;

        $this->categoryURI = $category_URI;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response->withStatus(404);
    }

    private function _category_title_from_URI(string $uri): string
    {
        $uri = str_replace('__', 'DOUBLEUNDERLINE', $uri);
        $uri = str_replace('_', ' ', $uri);
        $title = str_replace('DOUBLEUNDERLINE', '_', $uri);

        return $title;
    }
}
