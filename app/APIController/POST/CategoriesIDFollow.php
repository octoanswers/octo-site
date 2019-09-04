<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesIDFollow_POST_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $categoryID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');

            //
            // Validate params
            //

            $user = (new User_Query())->user_with_API_key($api_key);
            $userID = $user->id;

            $category = (new Category_Query($this->lang))->category_with_ID($categoryID);

            $relation = (new UsersFollowCategories_Relations_Query($this->lang))->relation_with_user_ID_and_category_ID($userID, $categoryID);
            if ($relation) {
                throw new Exception('User with ID "' . $userID . '" already followed category with ID "' . $categoryID . '"', 0);
            }

            //
            // Save UserFollowCategory relation
            //

            $relation = new UserFollowCategory_Relation_Model();
            $relation->userID = $userID;
            $relation->categoryID = $categoryID;

            $relation = (new UserFollowCategory_Relation_Mapper($this->lang))->create($relation);

            // Create activity

            $activity = new Activity_Model();
            $activity->type = Activity_Model::USER_FOLLOW_CATEGORY;
            $activity->subject = $user;
            $activity->data = $category;
            $activity = (new UFollowC_Activity_Mapper($this->lang))->create($activity);
            $output = [
                'lang'                    => $this->lang,
                'relation_id'             => $relation->id,
                'user_id'                 => $user->id,
                'user_name'               => $user->name,
                'followed_category_id'    => $category->id,
                'followed_category_title' => $category->title,
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
