<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class HashtagsToQuestions_Relations_Query extends Abstract_Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function findNewestForHashtagWithID(int $hashtagID, int $page = 1, int $per_page = 10): array
    {
        HashtagToQuestion_Relation_Validator::validateHashtagID($hashtagID);
        QuestionsList_Validator::validatePage($page);
        QuestionsList_Validator::validatePerPage($per_page);

        $offset = $per_page * ($page - 1);

        $stmt = $this->pdo->prepare('SELECT * FROM `er_hashtags_questions` WHERE er_hashtag_id = :er_hashtag_id ORDER BY er_id DESC LIMIT :id_offset, :per_page');
        $stmt->bindParam(':er_hashtag_id', $hashtagID, PDO::PARAM_INT);
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ERs = [];
        foreach ($rows as $row) {
            $ERs[] = HashtagsToQuestions_Relation_Model::initWithDBState($row);
        }

        return $ERs;
    }

    public function findByHashtagIDAndQuestionID(int $hashtagID, int $question_id)
    {
        HashtagToQuestion_Relation_Validator::validateHashtagID($hashtagID);
        HashtagToQuestion_Relation_Validator::validateQuestionID($question_id);

        $stmt = $this->pdo->prepare('SELECT * FROM er_hashtags_questions WHERE er_hashtag_id=:er_hashtag_id AND er_question_id=:er_question_id LIMIT 1');
        $stmt->bindParam(':er_hashtag_id', $hashtagID, PDO::PARAM_INT);
        $stmt->bindParam(':er_question_id', $question_id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return HashtagsToQuestions_Relation_Model::initWithDBState($row);
    }

    public function findByHashtagTitleAndQuestionID(string $hashtag_title, int $question_id)
    {
        Hashtag_Validator::validateTitle($hashtag_title);
        HashtagToQuestion_Relation_Validator::validateQuestionID($question_id);

        $hashtag = (new Hashtag_Query($this->lang))->findWithTitle($hashtag_title);
        if ($hashtag === null) {
            return null;
        }

        return (new HashtagsToQuestions_Relations_Query($this->lang))->findByHashtagIDAndQuestionID($hashtag->id, $question_id);
    }
}
