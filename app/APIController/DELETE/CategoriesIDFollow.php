<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesIDFollow_DELETE_APIController extends Abstract_APIController
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

            $user = (new User_Query())->user_with_API_key($api_key);

            $category = (new Category_Query($this->lang))->category_with_ID($category_ID);

            $relation = (new UsersFollowCategories_Relations_Query($this->lang))->relation_with_user_ID_and_category_ID($user->id, $category_ID);
            if (!$relation) {
                throw new Exception('User with ID "' . $user->id . '" not followed category with ID "' . $category_ID . '"', 0);
            }

            //
            // Delete follow record
            //

            (new UserFollowCategory_Relation_Mapper($this->lang))->delete_relation($relation);

            $output = [
                'user_id'             => $user->id,
                'user_name'           => $user->name,
                'unfollowed_category' => [
                    'id'    => $category->id,
                    'title' => $category->title,
                ],
            ];
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
