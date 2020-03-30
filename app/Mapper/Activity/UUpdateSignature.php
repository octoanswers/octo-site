<?php

namespace Mapper\Activity;

class UUpdateSignature extends \Mapper\Mapper
{
    public function create(\Model\Activity $activity): \Model\Activity
    {
        $activity_type = $activity->type;
        $user = $activity->subject;

        if (!isset($activity->data['signature'])) {
            throw new \Exception('Incorrect data param', 1);
        }

        $signature = $activity->data['signature'];

        if ($activity_type != \Model\Activity::U_UPDATE_SIGNATURE) {
            throw new \Exception("Incorrect activity type \"$activity_type\"", 0);
        }
        if (!is_a($user, \Model\User::class)) {
            throw new \Exception('Incorrect activity "subject" class type: '.get_class($user), 0);
        }
        // if (!is_a($signature, \Model\Revision::class)) {
        //     throw new \Exception('Incorrect activity "data" class type: '.get_class($revision), 0);
        // }

        $userID = $user->id;
        $data = json_encode([
            'user' => [
                'id'            => $user->id,
                'name'          => $user->name,
                'profile_url'   => $user->getURL($this->lang),
                'avatar_xs_url' => $user->getAvatarURLSmall(),
            ],
            'signature' => $signature,
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
