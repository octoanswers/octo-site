<?php

namespace Query;

class Contributors extends \Query\Query
{
    public function find_answer_contributors(int $answerID): array
    {
        $revisions = (new \Query\Revisions($this->lang))->revisions_for_answer_with_ID($answerID);
        $contributions = [];

        foreach ($revisions as $revision) {
            $revUserID = $revision->userID;
            if (isset($contributions[$revUserID])) {
                $contributions[$revUserID]['total'] += $revision->get_user_contribution();
                $contributions[$revUserID]['plus'] += $revision->get_user_insertions();
                $contributions[$revUserID]['minus'] += $revision->get_user_deletions();
            } else {
                $contributions[$revUserID]['total'] = $revision->get_user_contribution();
                $contributions[$revUserID]['plus'] = $revision->get_user_insertions();
                $contributions[$revUserID]['minus'] = $revision->get_user_deletions();
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

            $user = (new \Query\User())->user_with_ID($userID);

            $contributor = new \Model\User\Contributor();
            $contributor->id = $user->id;
            $contributor->username = $user->username;
            $contributor->name = $user->name;
            $contributor->email = $user->email;
            $contributor->createdAt = $user->createdAt;
            $contributor->contribution = $contribution;
            $contributor->insertionsCount = $insertionsCount;
            $contributor->deletionsCount = $deletionsCount;
            if ($user->signature) {
                $contributor->signature = $user->signature;
            }
            if ($user->site) {
                $contributor->site = $user->site;
            }

            $contributors[] = $contributor;
        }

        return $contributors;
    }
}
