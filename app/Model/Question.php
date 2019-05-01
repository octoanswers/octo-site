<?php

class Question_Model extends Abstract_Model
{
    use Question_Trait;
    use Question_URL_Trait;

    public $id; // int
    public $title; // string
    public $isRedirect = false; // bool
    public $answer; // Answer_Model
    public $hashtagsJSON; // string
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
        if (isset($state['a_hashtags'])) {
            $question->hashtagsJSON = $state['a_hashtags'];
        }

        $question->answer = Answer_Model::initWithDBState($state);
        
        return $question;
    }

    #
    # Get & Set
    #

    public function getHashtags(): array
    {
        $hashtags = [];

        if ($this->hashtagsJSON === null || strlen($this->hashtagsJSON) == 0) {
            return $hashtags;
        }

        $hashtagsArray = json_decode($this->hashtagsJSON, JSON_UNESCAPED_UNICODE);
        
        foreach ($hashtagsArray as $title) {
            $hashtag = new Hashtag;
            $hashtag->title = $title;
            $hashtags[] = $hashtag;
        }

        return $hashtags;
    }

    public function setHashtags(array $hashtags)
    {
        $hashtagsArray = [];

        // if (count($hashtags) == 0) {
        //     $this->hashtagsJSON = null;
        //     return;
        // }

        foreach ($hashtags as $hashtag) {
            if (!is_subclass_of($hashtag, Hashtag::class)) {
                throw new Exception("Hashtag must be subclass of Hashtag model", 1);
            }
            $hashtagsArray[] = $hashtag->title;
        }
        
    
        // $this->hashtags = ;
        $this->hashtagsJSON = json_encode($hashtagsArray, true);
    }
}
