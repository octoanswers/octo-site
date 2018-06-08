<?php

class Question_Model
{
    use Question_URL_Trait;
    
    private $id;
    private $title;
    private $isRedirect;
    private $answer;
    private $topics;
    private $imageBaseName;

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Question_Model
    {
        $question = new self();
        $question->setTitle($title);

        $question->setAnswer(new Answer_Model);

        return $question;
    }

    public static function initWithDBState(array $state): Question_Model
    {
        $question = new self();
        $question->id = (int) $state['q_id'];
        $question->setTitle($state['q_title']);
        $question->setRedirect((bool) $state['q_is_redirect']);
        $question->setImageBaseName($state['q_image_base_name']);
        $question->setTopicsJSON($state['a_topics']);

        $answer = Answer_Model::initWithDBState($state);
        $question->setAnswer($answer);

        return $question;
    }

    #
    # Get & Set
    #

    public function getID()
    {
        return $this->id;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function isRedirect(): bool
    {
        return $this->isRedirect ? true : false;
    }

    public function setRedirect(bool $isRedirect)
    {
        $this->isRedirect = $isRedirect ? 1 : 0;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setAnswer(Answer_Model $answer)
    {
        $this->answer = $answer;
    }

    public function getTopics()
    {
        return $this->topics;
    }

    public function setTopics(array $topics)
    {
        $this->topics = $topics;
    }

    public function getTopicsJSON()
    {
        if ($this->topics === null || count($this->topics) == 0) {
            return null;
        }

        return json_encode($this->topics, JSON_UNESCAPED_UNICODE);
    }

    public function setTopicsJSON($topicsJSON)
    {
        $this->topics = json_decode($topicsJSON, true);
    }

    public function getImageBaseName()
    {
        return $this->imageBaseName;
    }

    public function setImageBaseName($imageBaseName)
    {
        $this->imageBaseName = $imageBaseName;
    }
}
