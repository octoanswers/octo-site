<?php

namespace Model;

class Subscription extends Model
{
    use \Init_Subscription_Model_Trait;

    public $id;
    public $questionID;
    public $email;
    public $createdAt;
}
