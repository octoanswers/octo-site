<?php

class Question_Model
{
    use Question_Trait;
    use Question_URL_Trait;

    public $id; // int
    public $title;
    public $isRedirect; // bool
    public $answer; // Answer_Model
    public $topics;
    public $imageBaseName;

    #
    # Init methods
    #

    public static function initWithTitle(string $title): Question_Model
    {
        $question = new self();
        $question->setTitle($title);

        $question->answer = new Answer_Model;

        return $question;
    }

    public static function initWithDBState(array $state): Question_Model
    {
        $question = new self();
        $question->id = (int) $state['q_id'];
        $question->setTitle($state['q_title']);
        $question->setRedirect((bool) $state['q_is_redirect']);
        $question->imageBaseName = isset($state['q_image_base_name']) ? $state['q_image_base_name'] : null;
        if (isset($state['a_topics'])) {
            $question->setTopicsJSON($state['a_topics']);
        }

        $question->answer = Answer_Model::initWithDBState($state);
        
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

    public function getTopics(): array
    {
        return is_array($this->topics) ? $this->topics : [];
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

    public function setTopicsJSON(string $topicsJSON)
    {
        if (strlen($topicsJSON) == 0) {
            throw new Exception("Topics JSON must be longer than 0 char", 1);
        }

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
