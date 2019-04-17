<?php

class HAddedQ_Activity_Mapper extends Abstract_Mapper
{
    public function create(Activity_Model $activity): Activity_Model
    {
        $activity_type = $activity->type;
        $hashtag = $activity->subject;
        $question = $activity->data;

        if ($activity_type != Activity_Model::F_H_ADDED_Q) {
            throw new Exception("Incorrect activity type \"$activity_type\"", 0);
        }
        if (!is_a($hashtag, Hashtag_Model::class)) {
            throw new Exception('Incorrect activity "subject" class type: '.get_class($hashtag), 0);
        }
        if (!is_a($question, Question_Model::class)) {
            throw new Exception('Incorrect activity "data" class type: '.get_class($question), 0);
        }

        $hashtagID = $hashtag->getID();
        $data = json_encode([
            'hashtag' => [
                'title' => $hashtag->title,
                'url' => $hashtag->getURL($this->lang),
            ],
            'question' => [
                'title' => $question->title,
                'url' => $question->getURL($this->lang),
            ]
        ], JSON_UNESCAPED_UNICODE);

        $sql = 'INSERT INTO activities (h_id, activity_type, data) VALUES (:h_id, :activity_type, :data)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':h_id', $hashtagID, PDO::PARAM_INT);
        $stmt->bindParam(':activity_type', $activity_type, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $activity->setID((int) $this->pdo->lastInsertId());
        if ($activity->getID() === 0) {
            throw new Exception('Activity not saved', 1);
        }

        return $activity;
    }
}
