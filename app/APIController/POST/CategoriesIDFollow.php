<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesIDFollow extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $category_ID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');

            //
            // Validate params
            //

            $user = (new \Query\User())->user_with_API_key($api_key);
            $user_ID = $user->id;

            $category = (new \Query\Category($this->lang))->category_with_ID($category_ID);

            $relation = (new \Query\Relations\UsersFollowCategories($this->lang))->relation_with_user_ID_and_category_ID($user_ID, $category_ID);
            if ($relation) {
                throw new \Exception('User with ID "' . $user_ID . '" already followed category with ID "' . $category_ID . '"', 0);
            }

            //
            // Save UserFollowCategory relation
            //

            $relation = new \Model\Relation\UserFollowCategory();
            $relation->userID = $user_ID;
            $relation->categoryID = $category_ID;

            $relation = (new \Mapper\Relation\UserFollowCategory($this->lang))->create($relation);

            // Create activity

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::USER_FOLLOW_CATEGORY;
            $activity->subject = $user;
            $activity->data = $category;
            $activity = (new \Mapper\Activity\UFollowC($this->lang))->create($activity);
            $output = [
                'lang'                    => $this->lang,
                'relation_id'             => $relation->id,
                'user_id'                 => $user->id,
                'user_name'               => $user->name,
                'followed_category_id'    => $category->id,
                'followed_category_title' => $category->title,
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
