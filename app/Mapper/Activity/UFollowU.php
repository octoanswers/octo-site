<?php

class UFollowU_Activity_Mapper extends Abstract_Mapper
{
    public function create(Activity_Model $activity): Activity_Model
    {
        $user = $activity->getSubject();
        $followedUser = $activity->getData();

        if ($activity->getType() != Activity_Model::F_U_FOLLOW_U) {
            throw new Exception("Incorrect activity type: ".$activity->getType(), 0);
        }
        if (!is_a($user, User_Model::class)) {
            throw new Exception('Incorrect activity "subject" class type: '.get_class($user), 0);
        }
        if (!is_a($followedUser, User_Model::class)) {
            throw new Exception('Incorrect activity "data" class type: '.get_class($followedUser), 0);
        }

        $userID = $user->getID();
        $activity_type = $activity->getType();
        $data = json_encode([
            'user' => [
                'id' => $user->getID(),
                'name' => $user->getName(),
                'profile_url' => $user->getURL($this->lang),
                'avatar_xs_url' => $user->getAvatarSmallURL(),
            ],
            'followed_user' => [
                'id' => $followedUser->getID(),
                'name' => $followedUser->getName(),
                'profile_url' => $user->getURL($this->lang),
                'avatar_xs_url' => $user->getAvatarSmallURL(),
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

        $activity->setID((int) $this->pdo->lastInsertId());
        if ($activity->getID() === 0) {
            throw new Exception('Activity not saved', 1);
        }

        return $activity;
    }
}
