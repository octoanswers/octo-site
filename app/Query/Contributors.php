<?php

namespace Query;

class Contributors extends \Query\Query
{
    public function findAnswerContributors(int $answerID): array
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
