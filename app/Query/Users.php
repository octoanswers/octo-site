<?php

namespace Query;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Users
{
    protected $pdo;

    const MIN_PAGE = 0;
    const MAX_PAGE = 9999;
    const MIN_PER_PAGE = 5;
    const MAX_PER_PAGE = 100;

    public function __construct()
    {
        $this->pdo = \PDOFactory::get_connection_to_users_DB();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function users_newest(int $page = 0, int $perPage = 10)
    {
        try {
            v::optional(v::intType()->between(self::MIN_PAGE, self::MAX_PAGE, true))->assert($page);
        } catch (NestedValidationException $exception) {
            throw new \Exception('Optional "page" param ' . $exception->getMessages()[0], 0);
        }

        try {
            v::optional(v::intType()->between(self::MIN_PER_PAGE, self::MAX_PER_PAGE, true))->assert($perPage);
        } catch (NestedValidationException $exception) {
            throw new \Exception('Optional "perPage" param ' . $exception->getMessages()[0], 0);
        }

        $offset = $page * $perPage;

        $stmt = $this->pdo->prepare('SELECT * FROM users ORDER BY u_id DESC LIMIT :offset, :per_page');
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = \Model\User::init_with_DB_state($row);
        }

        return $users;
    }

    public function users_last_ID(): int
    {
        $stmt = $this->pdo->prepare('SELECT MAX(u_id) FROM users');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            throw new \Exception('Error', 1);
        }

        return (int) $result['MAX(u_id)'];
    }
}
