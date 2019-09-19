<?php

namespace APIController\DELETE;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesIDFollow extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $api_key = (string) $request->getParam('api_key');
            $category_ID = (int) $args['id'];

            //
            // Validate params
            //

            $user = (new \Query\User())->user_with_API_key($api_key);

            $category = (new \Query\Category($this->lang))->category_with_ID($category_ID);

            $relation = (new \Query\Relations\UsersFollowCategories($this->lang))->relation_with_user_ID_and_category_ID($user->id, $category_ID);
            if (!$relation) {
                throw new \Exception('User with ID "' . $user->id . '" not followed category with ID "' . $category_ID . '"', 0);
            }

            //
            // Delete follow record
            //

            (new \Mapper\Relation\UserFollowCategory($this->lang))->delete_relation($relation);

            $output = [
                'user_id'             => $user->id,
                'user_name'           => $user->name,
                'unfollowed_category' => [
                    'id'    => $category->id,
                    'title' => $category->title,
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
