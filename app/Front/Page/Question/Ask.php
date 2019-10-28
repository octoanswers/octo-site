<?php

namespace Front\Page\Question;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// @TODO Временно PC и Front\Page наследуются от одного \PageController\PageController
class Ask extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args)
    {
        $lang = (string) $request->getAttribute('lang');

        $controller = new \PageController\Question\Ask($lang);
        $view_data = $controller->get_data();
        $html = \Renderer\Page::render('question_ask', $view_data);

        $response->getBody()->write($html);

        return $response->withHeader('Content-Type', 'text/html');
    }
}
