<?php

namespace Mapper\Activity;

class UUpdateA extends \Mapper\Mapper
{
    public function create(\Model\Activity $activity): \Model\Activity
    {
        $activity_type = $activity->type;
        $user = $activity->subject;

        if (!isset($activity->data['question']) || !isset($activity->data['revision'])) {
            throw new \Exception('Incorrect data param', 1);
        }

        $question = $activity->data['question'];
        $revision = $activity->data['revision'];

        if ($activity_type != \Model\Activity::F_U_UPDATE_A) {
            throw new \Exception("Incorrect activity type \"$activity_type\"", 0);
        }
        if (!is_a($user, \Model\User::class)) {
            throw new \Exception('Incorrect activity "subject" class type: ' . get_class($user), 0);
        }
        if (!is_a($question, \Model\Question::class)) {
            throw new \Exception('Incorrect activity "data" class type: ' . get_class($question), 0);
        }
        if (!is_a($revision, \Model\Revision::class)) {
            throw new \Exception('Incorrect activity "data" class type: ' . get_class($revision), 0);
        }

        $fineDiffRender = new cogpowered\FineDiff\Render\Html;

        $userID = $user->id;
        $data = json_encode([
            'user' => [
                'id'            => $user->id,
                'name'          => $user->name,
                'profile_url'   => $user->get_URL($this->lang),
                'avatar_xs_url' => $user->get_avatar_URL_small(),
            ],
            'question' => [
                'title' => $question->title,
                'url'   => $question->get_URL($this->lang),
            ],
            'revision' => [
                'diff_text' => $fineDiffRender->process($revision->baseText, $revision->opcodes),
                'comment'   => $revision->comment,
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
