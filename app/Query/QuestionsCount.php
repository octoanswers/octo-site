<?php

class QuestionsCount_Query extends Abstract_Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function questions_last_ID(): int
    {
        $this->pdo = PDOFactory::get_connection_to_lang_DB($this->lang);

        $stmt = $this->pdo->prepare('SELECT MAX(q_id) FROM questions');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception('Error', 1);
        }

        return (int) $result['MAX(q_id)'];
    }

    public function count_questions_without_answers(): int
    {
        $this->pdo = PDOFactory::get_connection_to_lang_DB($this->lang);

        $stmt = $this->pdo->prepare('SELECT COUNT(*) AS questionsCount FROM questions WHERE a_text IS NULL AND q_is_redirect = 0');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception('Error', 1);
        }

        return (int) $result['questionsCount'];
    }

    public function count_questions_with_answers(): int
    {
        $this->pdo = PDOFactory::get_connection_to_lang_DB($this->lang);

        $stmt = $this->pdo->prepare('SELECT COUNT(*) AS questionsCount FROM questions WHERE a_len > 0 AND q_is_redirect = 0');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception('Error', 1);
        }

        return (int) $result['questionsCount'];
    }
}
