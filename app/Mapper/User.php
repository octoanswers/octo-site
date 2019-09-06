<?php

class User_Mapper extends Abstract_Mapper
{
    public function __construct()
    {
        $this->pdo = PDOFactory::get_connection_to_users_DB();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function create(User_Model $user): User_Model
    {
        User_Validator::validateNew($user);

        $sql = 'INSERT INTO users (u_username, u_name, u_email, u_signature, u_site, u_password_hash, u_api_key) VALUES (:u_username, :u_name, :u_email, :u_signature, :u_site, :u_password_hash, :u_api_key)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':u_username', $user->username, PDO::PARAM_STR);
        $stmt->bindParam(':u_name', $user->name, PDO::PARAM_STR);
        $stmt->bindParam(':u_email', $user->email, PDO::PARAM_STR);
        $stmt->bindParam(':u_signature', $user->signature, PDO::PARAM_STR);
        $stmt->bindParam(':u_site', $user->site, PDO::PARAM_STR);
        $stmt->bindParam(':u_password_hash', $user->passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':u_api_key', $user->apiKey, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $now = new DateTime('NOW');
        $user->createdAt = $now->format('Y-m-d H:i:s');

        $user->id = (int) $this->pdo->lastInsertId();
        if ($user->id === 0) {
            throw new Exception('User not saved', 1);
        }

        return $user;
    }

    public function update(User_Model $user): User_Model
    {
        User_Validator::validate_exists($user);

        $sql = 'UPDATE users SET u_username=:u_username, u_name=:u_name, u_email=:u_email, u_signature=:u_signature, u_site=:u_site, u_password_hash=:u_password_hash, u_api_key=:u_api_key WHERE u_id=:u_id';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':u_id', $user->id, PDO::PARAM_INT);
        $stmt->bindParam(':u_username', $user->username, PDO::PARAM_STR);
        $stmt->bindParam(':u_name', $user->name, PDO::PARAM_STR);
        $stmt->bindParam(':u_email', $user->email, PDO::PARAM_STR);
        $stmt->bindParam(':u_signature', $user->signature, PDO::PARAM_STR);
        $stmt->bindParam(':u_site', $user->site, PDO::PARAM_STR);
        $stmt->bindParam(':u_password_hash', $user->passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':u_api_key', $user->apiKey, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        if ($stmt->rowCount() == 0) {
            throw new Exception('User with ID ' . $user->id . ' not updated', 0);
        }

        return $user;
    }
}
