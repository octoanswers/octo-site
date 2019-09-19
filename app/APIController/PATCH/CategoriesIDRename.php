<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesIDRename_PATCH_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $category_ID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');
            $category_new_title = (string) $request->getParam('new_title');

            // Validate params

            $user = (new \Query\User())->user_with_API_key($api_key);

            // Change category title

            $category = (new \Query\Category($this->lang))->category_with_ID($category_ID);
            $old_title = $category->title;
            $category->title = $category_new_title;
            $category = (new \Mapper\Category($this->lang))->update($category);

            $is_save_redirect = (bool) $request->getParam('save_redirect');
            if ($is_save_redirect) {
                if (mb_strtolower($category_new_title) != mb_strtolower($old_title)) {
                    // create category record with OLD title & redirect flag
                    $old_category = new \Model\Category();
                    $old_category->title = $old_title;
                    $old_category->isRedirect = true;
                    $old_category = (new \Mapper\Category($this->lang))->create($old_category);

                    // create redirect record
                    $this->redirect = new \Model\Redirect\Category();
                    $this->redirect->from_ID = $old_category->id;
                    $this->redirect->to_title = $category->title;
                    $this->redirect = (new \Mapper\Redirect\Category($this->lang))->create($this->redirect);
                }
            }

            //
            // Create activities
            //

            $activity = new \Model\Activity();
            $activity->type = \Model\Activity::USER_RENAME_CATEGORY;
            $activity->subject = $user;
            $activity->data = ['category' => $category, 'old_title' => $old_title];
            $activity = (new \Mapper\Activity\UserRenameCategory($this->lang))->create($activity);

            $activity2 = new \Model\Activity();
            $activity2->type = \Model\Activity::CATEGORY_RENAMED_BY_USER;
            $activity2->subject = $category;
            $activity2->data = ['user' => $user, 'old_title' => $old_title];
            $activity2 = (new \Mapper\Activity\CategoryRenamedByUser($this->lang))->create($activity2);

            $output = [
                'category' => [
                    'id'        => $category->id,
                    'old_title' => $old_title,
                    'new_title' => $category->title,
                    'url'       => $category->get_URL($this->lang),
                ],
                'user' => [
                    'id'   => $user->id,
                    'name' => $user->name,
                ],
                'activities' => [
                    [
                        'id'   => $activity->id,
                        'type' => $activity->type,
                    ],
                    [
                        'id'   => $activity2->id,
                        'type' => $activity2->type,
                    ],
                ],
            ];

            if (isset($this->redirect)) {
                $output['redirect'] = [
                    'from_id'  => $this->redirect->from_ID,
                    'to_title' => $this->redirect->to_title,
                ];
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
