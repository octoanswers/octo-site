<?php

trait Init_Question_Model_Trait
{
    public static function init_with_title(string $title): self
    {
        $question = new self();
        $question->title = $title;

        $question->answer = new \Model\Answer();

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

        $question->answer = \Model\Answer::init_with_DB_state($state);

        return $question;
    }
}
