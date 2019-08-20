<?php

class UsersFollowQuestions_Relations_Query extends Abstract_Query
{
    public function relationWithUserIDAndQuestionID(int $userID, int $followedQuestionID)
    {
        $sql = 'SELECT * FROM er_users_follow_questions WHERE user_id=:user_id AND question_id=:question_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':question_id', $followedQuestionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return;
        }

        return UserFollowQuestion_Relation_Model::initWithDBState($row);
    }

    /**
     * List of questions that this specific user is following.
     */
    public function findQuestionsFollowedByUser(int $userID)
    {
        $sql = 'SELECT question_id FROM er_users_follow_questions WHERE (user_id=:user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $follows_questions = [];
        foreach ($results as $row) {
            $follows_questions[] = (int) $row['question_id'];
        }

        return $follows_questions;
    }
}
