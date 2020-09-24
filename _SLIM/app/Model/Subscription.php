<?php

namespace Model;

class Subscription extends Model
{
    use \Model\Traits\Subscription\Init;

    public $id;

    public $questionID;

    public $email;

    public $createdAt;
}
