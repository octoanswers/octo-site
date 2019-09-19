<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Categories_ID_Questions_PUT_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $api_key = (string) $request->getParam('api_key');
            $question_id = (int) $args['id'];

            $new_categories_string = urldecode((string) $request->getParam('new_categories'));

            if (strlen($new_categories_string) == 0) {
                throw new \Exception('Categories param not set', 0);
            }

            //
            // Validate params
            //

            $user = (new \Query\User())->user_with_API_key($api_key);

            $question = (new \Query\Question($this->lang))->question_with_ID($question_id);

            $old_categories_array = (new \Query\Categories($this->lang))->categories_for_question_with_ID($question->id);

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
                $category = (new \Query\Category($this->lang))->find_with_title($category_title);
                if ($category === null) {
                    $category = new \Model\Category();
                    $category->title = $category_title;

                    $category = (new \Mapper\Category($this->lang))->create($category);
                }

                $newCategories[] = $category;

                $er = (new \Query\Relations\CategoriesToQuestions($this->lang))->find_by_category_ID_and_question_ID($category->id, $question->id);
                if ($er === null) {
                    $er = new \Model\Relation\CategoriesToQuestions();
                    $er->categoryID = $category->id;
                    $er->questionID = $question->id;
                    $er = (new \Mapper\Relation\CategoryToQuestion($this->lang))->create($er);

                    // create activity
                    $activity = new \Model\Activity();
                    $activity->type = \Model\Activity::CATEGORY_ADDED_QUESTION;
                    $activity->subject = $category;
                    $activity->data = $question;
                    $activity = (new \Mapper\Activity\CAddedQ($this->lang))->create($activity);
                }
            }

            //
            // Update question
            //

            $question->categoriesCount = count($newCategories);
            $question = (new \Mapper\Question($this->lang))->updateCategoriesCount($question);

            // Save activity

            // $activity = new \Model\Activity();
            // $activity->type = \Model\Activity::F_U_UPDATE_A;
            // $activity->subject = $user;
            // $activity->data = ['question' => $question, 'revision' => $revision];
            // $activity = (new \Mapper\Activity\UUpdateA($this->lang))->create($activity);
            //
            // $activity = new \Model\Activity();
            // $activity->type = \Model\Activity::F_Q_UPDATE_A;
            // $activity->subject = $question;
            // $activity->data = ['user' => $user, 'revision' => $revision];
            // $activity = (new \Mapper\Activity\QUpdateA($this->lang))->create($activity);

            $output = [
                'lang'     => $this->lang,
                'question' => [
                    'id'    => $question->id,
                    'title' => $question->title,
                    'url'   => $question->get_URL($this->lang),
                ],
                'user_id'        => $user->id,
                'user_name'      => $user->name,
                'old_categories' => $oldCategoriesTitles,
                'new_categories' => $newCategoriesTitles,
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
