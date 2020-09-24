<?php

namespace Query;

class Answer extends \Query\Query
{
    public function findFirstEditor(int $answerID): ?\Model\User
    {
        \Validator\Answer::validateID($answerID);

        $sql = 'SELECT * FROM revisions WHERE rev_answer_id = :answer_id ORDER BY rev_created_at ASC LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':answer_id', $answerID, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $userID = $row['rev_user_id'];
        $user = (new \Query\User())->userWithID($userID);

        return $user;
    }

    public function findLastEditor(int $answerID): ?\Model\User
    {
        \Validator\Answer::validateID($answerID);

        $sql = 'SELECT * FROM revisions WHERE rev_answer_id = :answer_id ORDER BY rev_created_at DESC LIMIT 1';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':answer_id', $answerID, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $userID = $row['rev_user_id'];
        $user = (new \Query\User())->userWithID($userID);

        return $user;
    }

    public function findContributors(int $answerID): array
    {
        $revisions = (new \Query\Revisions($this->lang))->revisionsForAnswerWithID($answerID);

        $unsorted_contributions = [];

        foreach ($revisions as $revision) {
            $revUserID = $revision->userID;

            if (isset($unsorted_contributions[$revUserID])) {
                $unsorted_contributions[$revUserID]->contribution += $revision->getUserContribution();
                $unsorted_contributions[$revUserID]->insertionsCount += $revision->getUserInsertions();
                $unsorted_contributions[$revUserID]->deletionsCount += $revision->getUserDeletions();
            } else {
                $contribution = new \Model\ContributionToAnswer();

                $contribution->userID = $revUserID;
                $contribution->answerID = $answerID;
                $contribution->contribution = $revision->getUserContribution();
                $contribution->insertionsCount = $revision->getUserInsertions();
                $contribution->deletionsCount = $revision->getUserDeletions();

                $unsorted_contributions[$revUserID] = $contribution;
            }
        }

        $sorted_contributions = \Helper\Sort\Contributions::sortByContributions($unsorted_contributions);

        $sorted_contributors = [];
        foreach ($sorted_contributions as $user_contribution) {
            $userID = $user_contribution->userID;

            $user = (new \Query\User())->userWithID($userID);
            $user->contributionToAnswer = $user_contribution;

            $sorted_contributors[] = $user;
        }

        return $sorted_contributors;
    }
}
