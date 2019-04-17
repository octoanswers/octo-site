<?php

class User_Model extends Abstract_Model
{
    use User_URL_Trait;

    public $id; // int
    public $username; // string
    public $name; // string
    public $email; // string
    public $signature; // string
    public $site; // string
    public $passwordHash; // string
    public $apiKey; // string
    public $createdAt;

    #
    # Init methods
    #

    public static function initWithDBState(array $state): User_Model
    {
        $user = new self();

        $user->id = (int) $state['u_id'];
        $user->username = isset($state['u_username']) ? $state['u_username'] : null;
        $user->name = $state['u_name'];
        $user->email = $state['u_email'];
        $user->signature = isset($state['u_signature']) ? $state['u_signature'] : null;
        $user->site = isset($state['u_site']) ? $state['u_site'] : null;
        $user->passwordHash = isset($state['u_password_hash']) ? $state['u_password_hash'] : null;
        $user->apiKey = isset($state['u_api_key']) ? $state['u_api_key'] : null;
        $user->createdAt = $state['u_created_at'];

        return $user;
    }

    #
    # Get & Set
    #

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }
}
