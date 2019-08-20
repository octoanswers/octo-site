<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Search_Query extends Abstract_Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function searchQuestions(string $query, int $questionsPage = 1, int $questionsPerPage = 10): array
    {
        try {
            v::stringType()->length(2, 32, true)->assert($query);
        } catch (NestedValidationException $e) {
            throw new Exception('Search query param '.$e->getMessages()[0], 0);
        }

        List_Validator::validatePage($questionsPage);
        List_Validator::validatePerPage($questionsPerPage);

        $id_offset = 0;

        $sql = "SELECT * FROM questions WHERE (q_title LIKE '%".$query."%') LIMIT :id_offset, :per_page";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_offset', $id_offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $questionsPerPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $questions = [];
        foreach ($rows as $row) {
            $questions[] = Question_Model::initWithDBState($row);
        }

        return $questions;
    }

    public function searchCategories(string $query, int $page = 1, int $perPage = 10): array
    {
        try {
            v::stringType()->length(1, 32, true)->assert($query);
        } catch (NestedValidationException $e) {
            throw new Exception('Search query param '.$e->getMessages()[0], 0);
        }

        List_Validator::validatePage($page);
        List_Validator::validatePerPage($perPage);

        $id_offset = 0;

        $sql = "SELECT * FROM categories WHERE (c_title LIKE '%".$query."%') LIMIT :id_offset, :per_page";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_offset', $id_offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = Category::initWithDBState($row);
        }

        return $categories;
    }

    public function searchUsers(string $query, int $page = 1, int $perPage = 10): array
    {
        try {
            v::stringType()->length(2, 32, true)->assert($query);
        } catch (NestedValidationException $e) {
            throw new Exception('Search query param '.$e->getMessages()[0], 0);
        }

        List_Validator::validatePage($page);
        List_Validator::validatePerPage($perPage);

        $id_offset = 0;

        $sql = "SELECT * FROM users WHERE (u_name LIKE '%".$query."%') LIMIT :id_offset, :per_page";

        $this->pdo = PDOFactory::getConnectionToUsersDB();
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id_offset', $id_offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = User_Model::initWithDBState($row);
        }

        return $users;
    }
}
