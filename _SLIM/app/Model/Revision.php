<?php

namespace Model;

class Revision extends Model
{
    use \Model\Traits\Revision\Init;
    use \Model\Traits\Revision\Contribution;

    public $id;

    public $answerID;

    public $opcodes;

    public $baseText;

    public $comment;

    public $parentID;

    public $userID;

    public $createdAt;
}
