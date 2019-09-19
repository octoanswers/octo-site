<?php

namespace Mapper\Activity;

class CAddedQ extends \Mapper\Mapper
{
    public function create(\Model\Activity $activity): \Model\Activity
    {
        $category = $activity->subject;
        $question = $activity->data;

        if ($activity->type != \Model\Activity::CATEGORY_ADDED_QUESTION) {
            throw new \Exception("Incorrect activity type \"$activity->type\"", 0);
        }
        if (!is_a($category, \Model\Category::class)) {
            throw new \Exception('Incorrect activity "subject" class type: ' . get_class($category), 0);
        }
        if (!is_a($question, \Model\Question::class)) {
            throw new \Exception('Incorrect activity "data" class type: ' . get_class($question), 0);
        }

        $categoryID = $category->id;
        $data = json_encode([
            'category' => [
                'title' => $category->title,
                'url'   => $category->get_URL($this->lang),
            ],
            'question' => [
                'title' => $question->title,
                'url'   => $question->get_URL($this->lang),
            ],
        ], JSON_UNESCAPED_UNICODE);

        $sql = 'INSERT INTO activities (c_id, activity_type, data) VALUES (:c_id, :activity_type, :data)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':c_id', $categoryID, \PDO::PARAM_INT);
        $stmt->bindParam(':activity_type', $activity->type, \PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $activity->id = (int) $this->pdo->lastInsertId();
        if ($activity->id === 0) {
            throw new \Exception('Activity not saved', 1);
        }

        return $activity;
    }
}
