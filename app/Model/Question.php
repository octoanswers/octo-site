<?php

class Question_Model extends Abstract_Model
{
    use Question_Trait;
    use Question_URL_Trait;

    public $id; // int
    public $title;
    public $isRedirect; // bool
    public $answer; // Answer_Model
    public $hashtags;
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
        if (isset($state['a_hashtags'])) {
            $question->setHashtagsJSON($state['a_hashtags']);
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

    public function getHashtags(): array
    {
        return is_array($this->hashtags) ? $this->hashtags : [];
    }

    public function setHashtags(array $hashtags)
    {
        $this->hashtags = $hashtags;
    }

    public function getHashtagsJSON()
    {
        if ($this->hashtags === null || count($this->hashtags) == 0) {
            return null;
        }

        return json_encode($this->hashtags, JSON_UNESCAPED_UNICODE);
    }

    public function setHashtagsJSON(string $hashtagsJSON)
    {
        if (strlen($hashtagsJSON) == 0) {
            throw new Exception("Hashtags JSON must be longer than 0 char", 1);
        }

        $this->hashtags = json_decode($hashtagsJSON, true);
    }
}
