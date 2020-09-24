<?php

namespace Mapper\Activity;

class UserRenameCategory extends \Mapper\Mapper
{
    public function create(\Model\Activity $activity): \Model\Activity
    {
        $activity_type = $activity->type;
        if ($activity_type != \Model\Activity::USER_RENAME_CATEGORY) {
            throw new \Exception("Incorrect activity type \"$activity_type\"", 0);
        }

        $user = $activity->subject;
        if (!is_a($user, \Model\User::class)) {
            throw new \Exception('Incorrect activity "subject" class type: ' . get_class($user), 0);
        }

        if (!isset($activity->data['category']) || !isset($activity->data['old_title'])) {
            throw new \Exception('Incorrect data param', 1);
        }
        $category = $activity->data['category'];
        $old_title = $activity->data['old_title'];
        if (!is_a($category, \Model\Category::class)) {
            throw new \Exception('Incorrect activity "data" class type: ' . get_class($category), 0);
        }
        if (!is_string($old_title)) {
            throw new \Exception('Incorrect activity "data" type of old_title', 0);
        }

        $userID = $user->id;
        $data = json_encode([
            'user' => [
                'id'            => $user->id,
                'name'          => $user->name,
                'profile_url'   => $user->getURL($this->lang),
                'avatar_xs_url' => $user->getAvatarURLSmall(),
            ],
            'category' => [
                'title_old' => $old_title,
                'title_new' => $category->title,
                'url'       => $category->getURL($this->lang),
            ],
        ], JSON_UNESCAPED_UNICODE);

        $sql = 'INSERT INTO activities (u_id, activity_type, data) VALUES (:user_id, :activity_type, :data)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, \PDO::PARAM_INT);
        $stmt->bindParam(':activity_type', $activity_type, \PDO::PARAM_STR);
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
