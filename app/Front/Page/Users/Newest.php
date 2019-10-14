<?php

namespace Front\Page\Users;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// @TODO Временно PC и Front\Page наследуются от одного \PageController\PageController
class Newest extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args)
    {
        $lang = (string) $request->getAttribute('lang');

        $query_params = $request->getQueryParams();
        $page = (int) @$query_params['page'];

        $controller = new \PageController\Users\Newest($lang);
        $view_data = $controller->get_data('newest', $page);
        $html = \Renderer\Page::render('users', $view_data);

        $response->getBody()->write($html);

        return $response->withHeader('Content-Type', 'text/html');
    }
}
