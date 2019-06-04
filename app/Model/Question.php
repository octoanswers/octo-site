<?php

class Question_Model extends Abstract_Model
{
    use Question_Trait;
    use Question_URL_Trait;

    public $id; // int
    public $title; // string
    public $isRedirect = false; // bool
    public $answer; // Answer_Model
    public $categoriesJSON; // string
    public $imageBaseName;

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Question_Model
    {
        $question = new self();
        $question->title = $title;

        $question->answer = new Answer_Model;

        return $question;
    }

    public static function initWithDBState(array $state): Question_Model
    {
        $question = new self();
        $question->id = (int) $state['q_id'];
        $question->title = (string) $state['q_title'];
        $question->isRedirect = (bool) $state['q_is_redirect'];
        $question->imageBaseName = isset($state['q_image_base_name']) ? $state['q_image_base_name'] : null;
        if (isset($state['a_categories'])) {
            $question->categoriesJSON = $state['a_categories'];
        }

        $question->answer = Answer_Model::initWithDBState($state);
        
        return $question;
    }

    #
    # Get & Set
    #

    public function getCategories(): array
    {
        $categories = [];

        if ($this->categoriesJSON === null || strlen($this->categoriesJSON) == 0) {
            return $categories;
        }

        $categoriesArray = json_decode($this->categoriesJSON, JSON_UNESCAPED_UNICODE);
        
        foreach ($categoriesArray as $title) {
            $category = new Category;
            $category->title = $title;
            $categories[] = $category;
        }

        return $categories;
    }

    public function setCategories(array $categories)
    {
        $categoriesArray = [];

        foreach ($categories as $category) {
            if (!is_a($category, Category::class)) {
                throw new Exception("Category must be subclass of Category model", 1);
            }
            $categoriesArray[] = $category->title;
        }

        $this->categoriesJSON = json_encode($categoriesArray, true);
    }
}
