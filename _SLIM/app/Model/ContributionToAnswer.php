<?php

namespace Model;

class ContributionToAnswer extends Model
{
    public $userID; // int

    public $answerID; // int

    public $contribution; // int

    public $insertionsCount; // int

    public $deletionsCount; // int
}
