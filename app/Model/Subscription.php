<?php

class Subscription_Model extends Abstract_Model
{
    public $id;
    public $questionID;
    public $email;
    public $createdAt;

    // Init methods -----------------------------------------------------------

    public static function init_with_DB_state(array $state): self
    {
        $s = new self();
        $s->id = $state['s_id'];
        $s->questionID = $state['s_question_id'];
        $s->email = $state['s_email'];
        $s->createdAt = $state['s_created_at'];

        return $s;
    }
}
