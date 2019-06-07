<?php

class HAddedQ_Activity_Mapper extends Abstract_Mapper
{
    public function create(Activity_Model $activity): Activity_Model
    {
        $category = $activity->subject;
        $question = $activity->data;

        if ($activity->type != Activity_Model::F_H_ADDED_Q) {
            throw new Exception("Incorrect activity type \"$activity->type\"", 0);
        }
        if (!is_a($category, Category::class)) {
            throw new Exception('Incorrect activity "subject" class type: '.get_class($category), 0);
        }
        if (!is_a($question, Question_Model::class)) {
            throw new Exception('Incorrect activity "data" class type: '.get_class($question), 0);
        }

        $categoryID = $category->id;
        $data = json_encode([
            'category' => [
                'title' => $category->title,
                'url' => $category->getURL($this->lang),
            ],
            'question' => [
                'title' => $question->title,
                'url' => $question->getURL($this->lang),
            ]
        ], JSON_UNESCAPED_UNICODE);

        $sql = 'INSERT INTO activities (c_id, activity_type, data) VALUES (:c_id, :activity_type, :data)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':c_id', $categoryID, PDO::PARAM_INT);
        $stmt->bindParam(':activity_type', $activity->type, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $activity->id = (int) $this->pdo->lastInsertId();
        if ($activity->id === 0) {
            throw new Exception('Activity not saved', 1);
        }

        return $activity;
    }
}
