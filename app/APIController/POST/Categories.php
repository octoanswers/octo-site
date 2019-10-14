<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Categories extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $post_params = $request->getParsedBody();
            $api_key = (string) $post_params['api_key'];
            $categories_string = urldecode((string) $post_params['categories']);

            if (strlen($categories_string) == 0) {
                throw new \Exception('Categories param not set', 0);
            }

            //
            // Validate params
            //

            $user = (new \Query\User())->userWithAPIKey($api_key);

            //
            // Check & creat new categories, if needed
            //

            $category_titles = explode(',', $categories_string);

            $created_categories = [];
            $exists_categories = [];

            foreach ($category_titles as $category_title) {
                $category_title = trim($category_title);
                $category = (new \Query\Category($this->lang))->findWithTitle($category_title);
                if ($category === null) {
                    $category = new \Model\Category();
                    $category->title = $category_title;
                    $category = (new \Mapper\Category($this->lang))->create($category);

                    $created_categories[] = $category_title;
                } else {
                    $exists_categories[] = $category_title;
                }
            }

            $output = [
                'lang' => $this->lang,
                'user' => [
                    'id'   => $user->id,
                    'name' => $user->name,
                ],
                'categories' => [
                    'created' => $created_categories,
                    'exists'  => $exists_categories,
                ],
            ];
        } catch (\Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
