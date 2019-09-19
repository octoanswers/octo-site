<?php

namespace Query;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Search extends \Query\Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function search_questions(string $query, int $questionsPage = 1, int $questionsPerPage = 10): array
    {
        try {
            v::stringType()->length(2, 32, true)->assert($query);
        } catch (NestedValidationException $e) {
            throw new \Exception('Search query param ' . $e->getMessages()[0], 0);
        }

        \Validator\SearchList::validatePage($questionsPage);
        \Validator\SearchList::validatePerPage($questionsPerPage);

        $id_offset = 0;

        $sql = "SELECT * FROM questions WHERE (q_title LIKE '%" . $query . "%') LIMIT :id_offset, :per_page";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_offset', $id_offset, \PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $questionsPerPage, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $questions = [];
        foreach ($rows as $row) {
            $questions[] = \Model\Question::init_with_DB_state($row);
        }

        return $questions;
    }

    public function search_categories(string $query, int $page = 1, int $perPage = 10): array
    {
        try {
            v::stringType()->length(1, 32, true)->assert($query);
        } catch (NestedValidationException $e) {
            throw new \Exception('Search query param ' . $e->getMessages()[0], 0);
        }

        \Validator\SearchList::validatePage($page);
        \Validator\SearchList::validatePerPage($perPage);

        $id_offset = 0;

        $sql = "SELECT * FROM categories WHERE (c_title LIKE '%" . $query . "%') LIMIT :id_offset, :per_page";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_offset', $id_offset, \PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = \Model\Category::init_with_DB_state($row);
        }

        return $categories;
    }

    public function search_users(string $query, int $page = 1, int $perPage = 10): array
    {
        try {
            v::stringType()->length(2, 32, true)->assert($query);
        } catch (NestedValidationException $e) {
            throw new \Exception('Search query param ' . $e->getMessages()[0], 0);
        }

        \Validator\SearchList::validatePage($page);
        \Validator\SearchList::validatePerPage($perPage);

        $id_offset = 0;

        $sql = "SELECT * FROM users WHERE (u_name LIKE '%" . $query . "%') LIMIT :id_offset, :per_page";

        $this->pdo = \Helper\PDOFactory::get_connection_to_users_DB();
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id_offset', $id_offset, \PDO::PARAM_INT);
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
}
