<?php

class UFollowC_Activity_Mapper extends Abstract_Mapper
{
    public function create(Activity_Model $activity): Activity_Model
    {
        $user = $activity->subject;
        $category = $activity->data;

        if ($activity->type != Activity_Model::USER_FOLLOW_CATEGORY) {
            throw new Exception("Incorrect activity type", 0);
        }
        if (!is_a($user, User_Model::class)) {
            throw new Exception('Incorrect activity "subject" class type: '.get_class($user), 0);
        }
        if (!is_a($category, Category::class)) {
            throw new Exception('Incorrect activity "data" class type: '.get_class($category), 0);
        }

        $userID = $user->id;
        $activity_type = $activity->type;
        $data = json_encode([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'profile_url' => $user->getURL($this->lang),
                'avatar_xs_url' => $user->getAvatarSmallURL(),
            ],
            'category' => [
                'title' => $category->title,
                'url' => $category->getURL($this->lang),
            ]
        ], JSON_UNESCAPED_UNICODE);

        $sql = 'INSERT INTO activities (u_id, activity_type, data) VALUES (:user_id, :activity_type, :data)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
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