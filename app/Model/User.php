<?php

class User_Model extends Abstract_Model
{
    use Init_User_Model_Trait;
    use Avatar_User_Model_Trait;

    public $id; // int
    public $username; // string
    public $name; // string
    public $email; // string
    public $signature; // string
    public $site; // string
    public $passwordHash; // string
    public $apiKey; // string
    public $is_avatar_uploaded = false; // bool
    public $createdAt;
}
