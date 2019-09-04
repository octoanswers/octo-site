<?php

class Question_Model extends Abstract_Model
{
    use Question_Trait;
    use Question_URL_Trait;

    public $id; // int
    public $title; // string
    public $isRedirect = false; // bool
    public $answer; // Answer_Model
    public $imageBaseName;
    public $categoriesCount; // int

    //
    // Init methods
    //

    public static function init_with_title(string $title): self
    {
        $question = new self();
        $question->title = $title;

        $question->answer = new Answer_Model();

        return $question;
    }

    public static function init_with_DB_state(array $state): self
    {
        $question = new self();
        $question->id = (int) $state['q_id'];
        $question->title = (string) $state['q_title'];
        $question->isRedirect = (bool) $state['q_is_redirect'];
        $question->imageBaseName = isset($state['q_image_base_name']) ? $state['q_image_base_name'] : null;
        $question->categoriesCount = (int) $state['count_categories'];

        $question->answer = Answer_Model::init_with_DB_state($state);

        return $question;
    }
}
