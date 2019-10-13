<?php

namespace PageController\Users;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Newest extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args)
    {
        $query_params = $request->getQueryParams();

        $lang = (string) $args['lang'];
        $page = (int) @$query_params['page'];

        $controller = new \Controller\Users\Newest($lang);
        $view_data = $controller->get_data('newest', $page);
        $html = \Renderer\Page::render('users', $view_data);

        $response->getBody()->write($html);

        return $response->withHeader('Content-Type', 'text/html');
    }
}
