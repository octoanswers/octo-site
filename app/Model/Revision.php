<?php

namespace Model;

class Revision extends Model
{
    use \Traits\Model\Revision\Init;
    use \Traits\Model\Revision\Contribution;

    public $id;
    public $answerID;
    public $opcodes;
    public $baseText;
    public $comment;
    public $parentID;
    public $userID;
    public $createdAt;
}
