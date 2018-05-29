<?php

class Subscription_Model
{
    private $id;
    private $questionID;
    private $email;
    private $createdAt;

    // Init methods -----------------------------------------------------------

    public static function initWithDBState(array $state): Subscription_Model
    {
        $s = new self();
        $s->id = $state['s_id'];
        $s->questionID = $state['s_question_id'];
        $s->email = $state['s_email'];
        $s->createdAt = $state['s_created_at'];

        return $s;
    }

    // Getters & setters ------------------------------------------------------

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setQuestionID(int $id)
    {
        $this->questionID = $id;
    }

    public function getQuestionID()
    {
        return $this->questionID;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
