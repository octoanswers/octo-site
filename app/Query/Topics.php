<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Topics_Query extends Abstract_Query
{
    public function topicsLastID(): int
    {
        $stmt = $this->pdo->prepare('SELECT MAX(t_id) FROM topics');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception('Error', 1);
        }

        return (int) $result['MAX(t_id)'];
    }

    public function findNewest($page = 1, $perPage = 10): array
    {
        List_Validator::validatePage($page);
        List_Validator::validatePerPage($perPage);

        $topicsLastID = (new Topics_Query($this->lang))->topicsLastID();

        $offset = $topicsLastID - ($perPage * $page);

        $stmt = $this->pdo->prepare('SELECT * FROM `topics` WHERE `t_id` > :id_offset LIMIT :per_page');
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $topics = [];
        foreach ($rows as $row) {
            $topics[] = Topic_Model::initWithDBState($row);
        }

        return array_reverse($topics);
    }
}
