<?php

namespace Model;

class Revision extends Model
{
    use \Init_Revision_Model_Trait;
    use \Contribution_Revision_Model_Trait;

    public $id;
    public $answerID;
    public $opcodes;
    public $baseText;
    public $comment;
    public $parentID;
    public $userID;
    public $createdAt;
}
