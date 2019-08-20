<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class CategoriesIDRename_PATCH_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $categoryID = (int) $args['id'];
            $api_key = (string) $request->getParam('api_key');
            $categoryNewTitle = (string) $request->getParam('new_title');

            # Validate params

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->id;

            # Change category title

            $category = (new Category_Query($this->lang))->categoryWithID($categoryID);
            $old_title = $category->title;
            $category->title = $categoryNewTitle;
            $category = (new Category_Mapper($this->lang))->update($category);

            $saveRedirect = (bool) $request->getParam('save_redirect');
            if ($saveRedirect) {
                if (mb_strtolower($categoryNewTitle) != mb_strtolower($old_title)) {
                    # create category record with OLD title & redirect flag
                    $oldCategory = new Category;
                    $oldCategory->title = $old_title;
                    $oldCategory->isRedirect = true;
                    $oldCategory = (new Category_Mapper($this->lang))->create($oldCategory);

                    # create redirect record
                    $this->redirect = new Category_Redirect_Model();
                    $this->redirect->fromID = $oldCategory->id;
                    $this->redirect->toTitle = $category->title;
                    $this->redirect = (new Category_Redirect_Mapper($this->lang))->create($this->redirect);
                }
            }

            #
            # Create activities
            #

            $activity = new Activity_Model();
            $activity->type = Activity_Model::USER_RENAME_CATEGORY;
            $activity->subject = $user;
            $activity->data = ['category' => $category, 'old_title' => $old_title];
            $activity = (new UserRenameCategory_Activity_Mapper($this->lang))->create($activity);

            $activity2 = new Activity_Model();
            $activity2->type = Activity_Model::CATEGORY_RENAMED_BY_USER;
            $activity2->subject = $category;
            $activity2->data = ['user' => $user, 'old_title' => $old_title];
            $activity2 = (new CategoryRenamedByUser_Activity_Mapper($this->lang))->create($activity2);

            $output = [
                'category' => [
                    'id' => $category->id,
                    'old_title' => $old_title,
                    'new_title' => $category->title,
                    'url' => $category->get_URL($this->lang),
                ],
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                ],
                'activities' => [
                    [
                        'id' => $activity->id,
                        'type' => $activity->type,
                    ],
                    [
                        'id' => $activity2->id,
                        'type' => $activity2->type,
                    ],
                ]
            ];

            if (isset($this->redirect)) {
                $output['redirect'] = [
                    'from_id' => $this->redirect->fromID,
                    'to_title' => $this->redirect->toTitle,
                ];
            }
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
