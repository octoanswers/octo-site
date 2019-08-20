<?php

class CategoryRenamedByUser_Activity_Mapper extends Abstract_Mapper
{
    public function create(Activity_Model $activity): Activity_Model
    {
        $activity_type = $activity->type;
        if ($activity_type != Activity_Model::CATEGORY_RENAMED_BY_USER) {
            throw new Exception("Incorrect activity type \"$activity_type\"", 0);
        }

        $category = $activity->subject;
        if (!is_a($category, Category::class)) {
            throw new Exception('Incorrect activity "data" class type: ' . get_class($category), 0);
        }

        if (!isset($activity->data['user']) || !isset($activity->data['old_title'])) {
            throw new Exception("Incorrect data param", 1);
        }
        $user = $activity->data['user'];
        if (!is_a($user, User_Model::class)) {
            throw new Exception('Incorrect activity "subject" class type: ' . get_class($user), 0);
        }
        $old_title = $activity->data['old_title'];
        if (!is_string($old_title)) {
            throw new Exception('Incorrect activity "data" type of old_title', 0);
        }

        $categoryID = $category->id;
        $data = json_encode([
            'category' => [
                'title_old' => $old_title,
                'title_new' => $category->title,
                'url' => $category->get_URL($this->lang),
            ],
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'profile_url' => $user->get_URL($this->lang),
                'avatar_xs_url' => $user->get_avatar_URL_small(),
            ],
        ], JSON_UNESCAPED_UNICODE);

        $sql = 'INSERT INTO activities (c_id, activity_type, data) VALUES (:c_id, :activity_type, :data)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':c_id', $categoryID, PDO::PARAM_INT);
        $stmt->bindParam(':activity_type', $activity_type, PDO::PARAM_STR);
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
