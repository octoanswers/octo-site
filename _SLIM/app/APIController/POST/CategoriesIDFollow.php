<?php

namespace APIController\POST;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesIDFollow extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');
            $category_ID = (int) $request->getAttribute('id');

            $post_params = $request->getParsedBody();
            $api_key = (string) $post_params['api_key'];

            //
            // Validate params
            //

            $user = (new \Query\User())->userWithAPIKey($api_key);
            $user_ID = $user->id;

            $category = (new \Query\Category($lang))->categoryWithID($category_ID);

            $relation = (new \Query\Relations\UsersFollowCategories($lang))->relationWithUserIDAndCategoryID($user_ID, $category_ID);
            if ($relation) {
                throw new \Exception('User with ID "' . $user_ID . '" already followed category with ID "' . $category_ID . '"', 0);
            }

            //
            // Save UserFollowCategory relation
            //

            $relation = new \Model\Relation\UserFollowCategory();
            $relation->userID = $user_ID;
            $relation->categoryID = $category_ID;

            $relation = (new \Mapper\Relation\UserFollowCategory($lang))->create($relation);

            // Create activity

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::USER_FOLLOW_CATEGORY;
            $activity->subject = $user;
            $activity->data = $category;
            $activity = (new \Mapper\Activity\UFollowC($lang))->create($activity);
            $output = [
                'lang'                    => $lang,
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
