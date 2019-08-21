<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SearchCategories_GET_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $this->query = urldecode((string) $request->getParam('query'));

            $output = [];

            if ($this->query && strlen($this->query)) {
                $categories = (new Search_Query($this->lang))->searchCategories($this->query);

                foreach ($categories as $category) {
                    $output[] = [
                        'id'             => $category->id,
                        'display_string' => $category->title . ' – ' . $category->id,
                        'title'          => $category->title,
                    ];
                }
            }
        } catch (Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
