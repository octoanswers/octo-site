<?php

class User_Query
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = PDOFactory::get_connection_to_users_DB();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function user_with_API_key(string $apiKey): \Model\User
    {
        User_Validator::validateAPIKey($apiKey);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_api_key=:u_api_key LIMIT 1');
        $stmt->bindParam(':u_api_key', $apiKey, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            throw new Exception('Incorrect API-key', 1);
        }

        //unset($row['u_password_hash']);
        //unset($row['u_api_key']);

        return \Model\User::init_with_DB_state($row);
    }

    public function user_with_ID(int $userID): \Model\User
    {
        User_Validator::validateID($userID);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_id=:u_id LIMIT 1');
        $stmt->bindParam(':u_id', $userID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            throw new Exception('User not found', 1);
        }

        unset($row['u_password_hash']);
        unset($row['u_api_key']);

        return \Model\User::init_with_DB_state($row);
    }

    public function user_with_username(string $username)
    {
        User_Validator::validateUsername($username);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_username=:u_username LIMIT 1');
        $stmt->bindParam(':u_username', $username, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return;
        }

        unset($row['u_password_hash']);
        unset($row['u_api_key']);

        return \Model\User::init_with_DB_state($row);
    }

    public function user_with_email(string $email)
    {
        User_Validator::validateEmail($email);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_email = :u_email LIMIT 1');
        $stmt->bindParam(':u_email', $email);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return;
        }

        return \Model\User::init_with_DB_state($row);
    }
}
