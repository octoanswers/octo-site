<?php

class Contributors_Query extends Abstract_Query
{
    public function findAnswerContributors(int $answerID): array
    {
        $revisions = (new Revisions_Query($this->lang))->revisionsForAnswerWithID($answerID);
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
                'user_id' => $key,
                'contribution' => $value['total'],
                'plus' => $value['plus'],
                'minus' => $value['minus'],
            ];
        }

        $sortedContributorsData = Contributors_Sort_Helper::sortByContributions($contributorsData);

        $contributors = [];
        foreach ($sortedContributorsData as $contributorData) {
            $userID = $contributorData['user_id'];
            $contribution = $contributorData['contribution'];
            $insertionsCount = $contributorData['plus'];
            $deletionsCount = $contributorData['minus'];

            $user = (new User_Query())->userWithID($userID);

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
