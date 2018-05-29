<?php

class User_Model
{
    private $id;
    private $username;
    private $name;
    private $email;
    private $signature;
    private $site;
    private $passwordHash;
    private $apiKey;
    private $createdAt;

    #
    # Init methods
    #

    public static function initWithDBState(array $state): User_Model
    {
        $user = new self();

        $user->id = (int) $state['u_id'];
        $user->username = $state['u_username'];
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

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSignature(string $signature)
    {
        $this->signature = $signature;
    }

    public function getSignature()
    {
        return $this->signature;
    }

    public function setSite(string $site)
    {
        $this->site = $site;
    }

    public function getSite()
    {
        return $this->site;
    }

    public function setPasswordHash(string $passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    public function setAPIKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getAPIKey()
    {
        return $this->apiKey;
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
