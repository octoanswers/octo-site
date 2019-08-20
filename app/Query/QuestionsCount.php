<?php

class QuestionsCount_Query extends Abstract_Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function questionsLastID(): int
    {
        $this->pdo = PDOFactory::getConnectionToLangDB($this->lang);

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

    public function countQuestionsWithoutAnswers(): int
    {
        $this->pdo = PDOFactory::getConnectionToLangDB($this->lang);

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

    public function countQuestionsWithAnswers(): int
    {
        $this->pdo = PDOFactory::getConnectionToLangDB($this->lang);

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
