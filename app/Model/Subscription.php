<?php

namespace Model;

class Subscription extends Model
{
    use \Traits\Model\Subscription\Init;

    public $id;
    public $questionID;
    public $email;
    public $createdAt;
}
