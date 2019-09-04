<?php

class Contributors_Query extends Abstract_Query
{
    public function find_answer_contributors(int $answerID): array
    {
        $revisions = (new Revisions_Query($this->lang))->revisions_for_answer_with_ID($answerID);
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

        $sortedContributorsData = Contributors_Sort_Helper::sort_by_contributions($contributorsData);

        $contributors = [];
        foreach ($sortedContributorsData as $contributorData) {
            $userID = $contributorData['user_id'];
            $contribution = $contributorData['contribution'];
            $insertionsCount = $contributorData['plus'];
            $deletionsCount = $contributorData['minus'];

            $user = (new User_Query())->user_with_ID($userID);

            $contributor = new Contributor_Model();
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
