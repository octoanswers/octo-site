<?php

namespace APIController\PUT\Questions\ID;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Categories extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang = $request->getAttribute('lang');

            $query_params = $request->getQueryParams();
            $api_key = (string) $query_params['api_key'];
            $question_id = (int) $request->getAttribute('id');

            $new_categories_string = urldecode((string) @$query_params['new_categories']);

            if (strlen($new_categories_string) == 0) {
                throw new \Exception('Categories param not set', 0);
            }

            //
            // Validate params
            //

            $user = (new \Query\User())->userWithAPIKey($api_key);

            $question = (new \Query\Question($lang))->questionWithID($question_id);

            $old_categories_array = (new \Query\Categories($lang))->categoriesForQuestionWithID($question->id);

            $oldCategoriesTitles = [];
            foreach ($old_categories_array as $category) {
                $oldCategoriesTitles[] = $category->title;
            }

            // Check categories-questions ER & creat new, if needed

            $newCategoriesTitles = explode(',', $new_categories_string);

            foreach ($newCategoriesTitles as &$categoryTitle) {
                $categoryTitle = trim($categoryTitle);
            }

            $newCategories = [];
            foreach ($newCategoriesTitles as $category_title) {
                $category = (new \Query\Category($lang))->categoryWithTitle($category_title);
                if ($category === null) {
                    $category = new \Model\Category();
                    $category->title = $category_title;

                    $category = (new \Mapper\Category($lang))->create($category);
                }

                $newCategories[] = $category;

                $er = (new \Query\Relations\CategoriesToQuestions($lang))->findByCategoryIDAndQuestionID($category->id, $question->id);
                if ($er === null) {
                    $er = new \Model\Relation\CategoriesToQuestions();
                    $er->categoryID = $category->id;
                    $er->questionID = $question->id;
                    $er = (new \Mapper\Relation\CategoryToQuestion($lang))->create($er);

                    // create activity
                    $activity = new \Model\Activity();
                    $activity->type = \Model\Activity::CATEGORY_ADDED_QUESTION;
                    $activity->subject = $category;
                    $activity->data = $question;
                    $activity = (new \Mapper\Activity\CAddedQ($lang))->create($activity);
                }
            }

            //
            // Update question
            //

            $question->categoriesCount = count($newCategories);
            $question = (new \Mapper\Question($lang))->updateCategoriesCount($question);

            // Save activity

            // $activity = new \Model\Activity();
            // $activity->type = \Model\Activity::F_U_UPDATE_A;
            // $activity->subject = $user;
            // $activity->data = ['question' => $question, 'revision' => $revision];
            // $activity = (new \Mapper\Activity\UUpdateA($lang))->create($activity);
            //
            // $activity = new \Model\Activity();
            // $activity->type = \Model\Activity::F_Q_UPDATE_A;
            // $activity->subject = $question;
            // $activity->data = ['user' => $user, 'revision' => $revision];
            // $activity = (new \Mapper\Activity\QUpdateA($lang))->create($activity);

            $output = [
                'lang'     => $lang,
                'question' => [
                    'id'    => $question->id,
                    'title' => $question->title,
                    'url'   => $question->getURL($lang),
                ],
                'user_id'        => $user->id,
                'user_name'      => $user->name,
                'old_categories' => $oldCategoriesTitles,
                'new_categories' => $newCategoriesTitles,
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
