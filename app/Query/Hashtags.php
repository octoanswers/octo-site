<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Hashtags_Query extends Abstract_Query
{
    public function hashtagsLastID(): int
    {
        $stmt = $this->pdo->prepare('SELECT MAX(h_id) FROM hashtags');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception('Error', 1);
        }

        return (int) $result['MAX(h_id)'];
    }

    public function findNewest($page = 1, $perPage = 10): array
    {
        List_Validator::validatePage($page);
        List_Validator::validatePerPage($perPage);

        $hashtagsLastID = (new Hashtags_Query($this->lang))->hashtagsLastID();

        $offset = $hashtagsLastID - ($perPage * $page);

        $stmt = $this->pdo->prepare('SELECT * FROM hashtags WHERE `h_id` > :id_offset LIMIT :per_page');
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $hashtags = [];
        foreach ($rows as $row) {
            $hashtags[] = Hashtag::initWithDBState($row);
        }

        return array_reverse($hashtags);
    }
}
