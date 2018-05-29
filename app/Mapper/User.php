<?php

class User_Mapper extends Abstract_Mapper
{
    public function __construct()
    {
        $this->pdo = PDOFactory::getConnectionToUsersDB();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function create(User_Model $user): User_Model
    {
        User_Validator::validateNew($user);

        $u_username = $user->getUsername();
        $u_name = $user->getName();
        $u_email = $user->getEmail();
        $u_signature = $user->getSignature();
        $u_site = $user->getSite();
        $u_password_hash = $user->getPasswordHash();
        $u_api_key = $user->getAPIKey();
        $u_created_at = $user->getCreatedAt();

        $sql = 'INSERT INTO users (u_username, u_name, u_email, u_signature, u_site, u_password_hash, u_api_key) VALUES (:u_username, :u_name, :u_email, :u_signature, :u_site, :u_password_hash, :u_api_key)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':u_username', $u_username, PDO::PARAM_STR);
        $stmt->bindParam(':u_name', $u_name, PDO::PARAM_STR);
        $stmt->bindParam(':u_email', $u_email, PDO::PARAM_STR);
        $stmt->bindParam(':u_signature', $u_signature, PDO::PARAM_STR);
        $stmt->bindParam(':u_site', $u_site, PDO::PARAM_STR);
        $stmt->bindParam(':u_password_hash', $u_password_hash, PDO::PARAM_STR);
        $stmt->bindParam(':u_api_key', $u_api_key, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $now = new DateTime('NOW');
        $user->setCreatedAt($now->format('Y-m-d H:i:s'));

        $userID = (int) $this->pdo->lastInsertId();
        $user->setID($userID);
        if ($user->getID() === 0) {
            throw new Exception('User not saved', 1);
        }

        return $user;
    }

    public function update(User_Model $user): User_Model
    {
        User_Validator::validateExists($user);

        $u_id = (int) $user->getID();
        $u_username = $user->getUsername();
        $u_name = $user->getName();
        $u_email = $user->getEmail();
        $u_signature = $user->getSignature();
        $u_site = $user->getSite();
        $u_password_hash = $user->getPasswordHash();
        $u_api_key = $user->getAPIKey();

        $sql = 'UPDATE users SET u_username=:u_username, u_name=:u_name, u_email=:u_email, u_signature=:u_signature, u_site=:u_site, u_password_hash=:u_password_hash, u_api_key=:u_api_key WHERE u_id=:u_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':u_id', $u_id, PDO::PARAM_INT);
        $stmt->bindParam(':u_username', $u_username, PDO::PARAM_STR);
        $stmt->bindParam(':u_name', $u_name, PDO::PARAM_STR);
        $stmt->bindParam(':u_email', $u_email, PDO::PARAM_STR);
        $stmt->bindParam(':u_signature', $u_signature, PDO::PARAM_STR);
        $stmt->bindParam(':u_site', $u_site, PDO::PARAM_STR);
        $stmt->bindParam(':u_password_hash', $u_password_hash, PDO::PARAM_STR);
        $stmt->bindParam(':u_api_key', $u_api_key, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        $count = $stmt->rowCount();
        if ($count == 0) {
            throw new Exception('User with ID '.$u_id.' not updated', 0);
        }

        return $user;
    }
}
