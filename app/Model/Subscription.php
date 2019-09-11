<?php

class Subscription_Model extends Abstract_Model
{
    use Init_Subscription_Model_Trait;

    public $id;
    public $questionID;
    public $email;
    public $createdAt;
}
