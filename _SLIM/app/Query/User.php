<?php

namespace Query;

class User
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = \Helper\PDOFactory::getConnectionToUsersDB();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function userWithAPIKey(string $apiKey): \Model\User
    {
        \Validator\User::validateAPIKey($apiKey);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_api_key=:u_api_key LIMIT 1');
        $stmt->bindParam(':u_api_key', $apiKey, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            throw new \Exception('Incorrect API-key', 1);
        }

        //unset($row['u_password_hash']);
        //unset($row['u_api_key']);

        return \Model\User::initWithDBState($row);
    }

    public function userWithID(int $userID): \Model\User
    {
        \Validator\User::validateID($userID);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_id=:u_id LIMIT 1');
        $stmt->bindParam(':u_id', $userID, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            throw new \Exception('User not found', 1);
        }

        unset($row['u_password_hash']);
        unset($row['u_api_key']);

        return \Model\User::initWithDBState($row);
    }

    public function userWithUsername(string $username)
    {
        \Validator\User::validateUsername($username);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_username=:u_username LIMIT 1');
        $stmt->bindParam(':u_username', $username, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return;
        }

        unset($row['u_password_hash']);
        unset($row['u_api_key']);

        return \Model\User::initWithDBState($row);
    }

    public function userWithEmail(string $email)
    {
        \Validator\User::validateEmail($email);

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE u_email = :u_email LIMIT 1');
        $stmt->bindParam(':u_email', $email);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return;
        }

        return \Model\User::initWithDBState($row);
    }
}
