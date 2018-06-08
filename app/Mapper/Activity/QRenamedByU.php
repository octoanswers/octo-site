<?php

class QRenamedByU_Activity_Mapper extends Abstract_Mapper
{
    public function create(Activity_Model $activity): Activity_Model
    {
        $activity_type = $activity->getType();
        if ($activity_type != Activity_Model::Q_RENAMED_BY_U) {
            throw new Exception("Incorrect activity type \"$activity_type\"", 0);
        }

        $question = $activity->getSubject();
        if (!is_a($question, Question_Model::class)) {
            throw new Exception('Incorrect activity "data" class type: '.get_class($question), 0);
        }

        if (!isset($activity->getData()['user']) || !isset($activity->getData()['old_title'])) {
            throw new Exception("Incorrect data param", 1);
        }
        $user = $activity->getData()['user'];
        if (!is_a($user, User_Model::class)) {
            throw new Exception('Incorrect activity "subject" class type: '.get_class($user), 0);
        }
        $old_title = $activity->getData()['old_title'];
        if (!is_string($old_title)) {
            throw new Exception('Incorrect activity "data" type of old_title', 0);
        }

        $questionID = $question->getID();
        $data = json_encode([
            'question' => [
                'title_old' => $old_title,
                'title_new' => $question->getTitle(),
                'url' => Question_URL_Helper::getURL($this->lang, $question),
            ],
            'user' => [
                'id' => $user->getID(),
                'name' => $user->getName(),
                'profile_url' => $user->getURL($this->lang),
                'avatar_xs_url' => $user->getAvatarSmallURL(),
            ],
        ], JSON_UNESCAPED_UNICODE);

        $sql = 'INSERT INTO activities (q_id, activity_type, data) VALUES (:q_id, :activity_type, :data)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_id', $questionID, PDO::PARAM_INT);
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
