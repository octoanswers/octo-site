<?php

class Sandbox_Query extends Abstract_Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function find_newest_without_answer($page = 1, $perPage = 10): array
    {
        \Validator\QuestionsList::validatePage($page);
        \Validator\QuestionsList::validatePerPage($perPage);

        $this->pdo = PDOFactory::get_connection_to_lang_DB($this->lang);

        $offset = $perPage * ($page - 1);

        $stmt = $this->pdo->prepare('SELECT * FROM `questions` WHERE a_len = 0 AND q_is_redirect = 0 ORDER BY q_id DESC LIMIT :id_offset, :per_page');
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $questions = [];
        foreach ($rows as $row) {
            $questions[] = \Model\Question::init_with_DB_state($row);
        }

        return $questions;
    }

    public function questions_without_categories($page = 1, $perPage = 10): array
    {
        \Validator\QuestionsList::validatePage($page);
        \Validator\QuestionsList::validatePerPage($perPage);

        $this->pdo = PDOFactory::get_connection_to_lang_DB($this->lang);

        $offset = $perPage * ($page - 1);

        $query = 'SELECT * FROM `questions` WHERE count_categories = 0 AND q_is_redirect = 0 ORDER BY `questions`.`a_updated_at` DESC LIMIT :offset, :per_page';

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $questions = [];
        foreach ($rows as $row) {
            $questions[] = \Model\Question::init_with_DB_state($row);
        }

        return $questions;
    }
}
