<?php

namespace Query;

class Contributors extends \Query\Query
{
    public function findAnswerContributors(int $answerID): array
    {
        $revisions = (new \Query\Revisions($this->lang))->revisionsForAnswerWithID($answerID);

        $contributions = [];
        foreach ($revisions as $revision) {
            $revUserID = $revision->userID;
            if (isset($contributions[$revUserID])) {
                $contributions[$revUserID]['total'] += $revision->getUserContribution();
                $contributions[$revUserID]['plus'] += $revision->getUserInsertions();
                $contributions[$revUserID]['minus'] += $revision->getUserDeletions();
            } else {
                $contributions[$revUserID]['total'] = $revision->getUserContribution();
                $contributions[$revUserID]['plus'] = $revision->getUserInsertions();
                $contributions[$revUserID]['minus'] = $revision->getUserDeletions();
            }
        }

        $contributorsData = [];
        foreach ($contributions as $userID => $value) {

            $contribution = new \Model\ContributionToAnswer();
            $contribution->userID = $userID;
            $contribution->answerID = $answerID;
            $contribution->contribution = $value['total'];
            $contribution->insertionsCount = $value['plus'];
            $contribution->deletionsCount = $value['minus'];

            $contributorsData[] = $contribution;
        }

        $sorted_contributions = \Helper\Sort\Contributions::sortByContributions($contributorsData);

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
