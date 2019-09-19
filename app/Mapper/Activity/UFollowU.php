<?php

namespace Mapper\Activity;

class UFollowU extends \Mapper\Mapper
{
    public function create(\Model\Activity $activity): \Model\Activity
    {
        $user = $activity->subject;
        $followedUser = $activity->data;

        if ($activity->type != \Model\Activity::F_U_FOLLOW_U) {
            throw new \Exception('Incorrect activity type: ' . $activity->type, 0);
        }
        if (!is_a($user, \Model\User::class)) {
            throw new \Exception('Incorrect activity "subject" class type: ' . get_class($user), 0);
        }
        if (!is_a($followedUser, \Model\User::class)) {
            throw new \Exception('Incorrect activity "data" class type: ' . get_class($followedUser), 0);
        }

        $userID = $user->id;
        $activity_type = $activity->type;
        $data = json_encode([
            'user' => [
                'id'            => $user->id,
                'name'          => $user->name,
                'profile_url'   => $user->get_URL($this->lang),
                'avatar_xs_url' => $user->get_avatar_URL_small(),
            ],
            'followed_user' => [
                'id'            => $followedUser->id,
                'name'          => $followedUser->name,
                'profile_url'   => $user->get_URL($this->lang),
                'avatar_xs_url' => $user->get_avatar_URL_small(),
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
