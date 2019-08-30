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

            $user = (new User_Query())->userWithAPIKey($api_key);
            $userID = $user->id;

            $question = (new Question_Query($this->lang))->questionWithID($question_id);
            $questionID = $question->id;

            $old_categories_array = (new Categories_Query($this->lang))->categoriesForQuestionWithID($question->id);

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
                $category = (new Category_Query($this->lang))->findWithTitle($category_title);
                if ($category === null) {
                    $category = new Category_Model();
                    $category->title = $category_title;

                    $category = (new Category_Mapper($this->lang))->create($category);
                }

                $newCategories[] = $category;

                $er = (new CategoriesToQuestions_Relations_Query($this->lang))->findByCategoryIDAndQuestionID($category->id, $question->id);
                if ($er === null) {
                    $er = new CategoriesToQuestions_Relation_Model();
                    $er->categoryID = $category->id;
                    $er->questionID = $question->id;
                    $er = (new CategoryToQuestion_Relation_Mapper($this->lang))->create($er);

                    // create activity
                    $activity = new Activity_Model();
                    $activity->type = Activity_Model::CATEGORY_ADDED_QUESTION;
                    $activity->subject = $category;
                    $activity->data = $question;
                    $activity = (new CAddedQ_Activity_Mapper($this->lang))->create($activity);
                }
            }

            //
            // Update question
            //

            $question->categoriesCount = count($newCategories);
            $question = (new Question_Mapper($this->lang))->updateCategoriesCount($question);

            // Save activity

            // $activity = new Activity_Model();
            // $activity->type = Activity_Model::F_U_UPDATE_A;
            // $activity->subject = $user;
            // $activity->data = ['question' => $question, 'revision' => $revision];
            // $activity = (new UUpdateA_Activity_Mapper($this->lang))->create($activity);
            //
            // $activity = new Activity_Model();
            // $activity->type = Activity_Model::F_Q_UPDATE_A;
            // $activity->subject = $question;
            // $activity->data = ['user' => $user, 'revision' => $revision];
            // $activity = (new QUpdateA_Activity_Mapper($this->lang))->create($activity);

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
