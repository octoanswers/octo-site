<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Categories_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $api_key = (string) $request->getParam('api_key');
            $categories_string = urldecode((string) $request->getParam('categories'));

            if (strlen($categories_string) == 0) {
                throw new \Exception("Categories param not set", 0);
            }

            #
            # Validate params
            #

            $user = (new User_Query())->userWithAPIKey($api_key);

            #
            # Check & creat new categories, if needed
            #

            $category_titles = explode(',', $categories_string);

            $created_categories = [];
            $exists_categories = [];

            foreach ($category_titles as $category_title) {
                $category_title = trim($category_title);
                $category = (new Category_Query($this->lang))->findWithTitle($category_title);
                if ($category === null) {
                    $category = new Category();
                    $category->title = $category_title;
                    $category = (new Category_Mapper($this->lang))->create($category);

                    $created_categories[] = $category_title;
                } else {
                    $exists_categories[] = $category_title;
                }
            }

            $output = [
                'lang' => $this->lang,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                ],
                'categories' => [
                    'created' => $created_categories,
                    'exists' => $exists_categories,
                ]
            ];
        } catch (Throwable $e) {
            $output = [
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
