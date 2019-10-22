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
        foreach ($contributions as $key => $value) {
            $contributorsData[] = [
                'user_id'      => $key,
                'contribution' => $value['total'],
                'plus'         => $value['plus'],
                'minus'        => $value['minus'],
            ];
        }

        $sortedContributorsData = \Helper\Sort\Contributors::sortByContributions($contributorsData);

        $contributors = [];
        foreach ($sortedContributorsData as $contributorData) {
            $userID = $contributorData['user_id'];
            $contribution = $contributorData['contribution'];
            $insertionsCount = $contributorData['plus'];
            $deletionsCount = $contributorData['minus'];

            $user = (new \Query\User())->userWithID($userID);

            $contributor = new \Model\User\Contributor();
            $contributor->id = $user->id;
            $contributor->username = $user->username;
            $contributor->name = $user->name;
            $contributor->email = $user->email;
            $contributor->is_avatar_uploaded = $user->is_avatar_uploaded;
            $contributor->createdAt = $user->createdAt;
            if ($user->signature) {
                $contributor->signature = $user->signature;
            }
            if ($user->site) {
                $contributor->site = $user->site;
            }

            $contributor->contribution = $contribution;
            $contributor->insertionsCount = $insertionsCount;
            $contributor->deletionsCount = $deletionsCount;

            $contributors[] = $contributor;
        }

        return $contributors;
    }
}
