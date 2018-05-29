<?php

class Contributor_Model extends User_Model
{
    private $contribution;
    private $insertionsCount;
    private $deletionsCount;

    #
    # Get & Set
    #

    public function getContribution()
    {
        return $this->contribution;
    }

    public function setContribution(int $contribution)
    {
        $this->contribution = $contribution;
    }

    public function getInsertionsCount()
    {
        return $this->insertionsCount;
    }

    public function setInsertionsCount(int $insertionsCount)
    {
        $this->insertionsCount = $insertionsCount;
    }

    public function getDeletionsCount()
    {
        return $this->deletionsCount;
    }

    public function setDeletionsCount(int $deletionsCount)
    {
        $this->deletionsCount = $deletionsCount;
    }
}
