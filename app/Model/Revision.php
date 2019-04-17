<?php

class Revision_Model extends Abstract_Model
{
    private $id;
    private $answerID;
    private $opcodes;
    private $baseText;
    private $comment;
    private $parentID;
    private $userID;
    public $createdAt;

    #
    # Init methods
    #

    public static function initWithDBState(array $state): Revision_Model
    {
        $revision = new self();

        $revision->id = (int) $state['rev_id'];
        $revision->answerID = (int) $state['rev_answer_id'];
        $revision->opcodes = $state['rev_opcodes'];
        $revision->baseText = $state['rev_base_text'];
        $revision->comment = isset($state['rev_comment']) ? $state['rev_comment'] : null;
        $revision->parentID = isset($state['rev_parent_id']) ? $state['rev_parent_id'] : null;
        $revision->userID = (int) $state['rev_user_id'];
        $revision->createdAt = $state['rev_created_at'];

        return $revision;
    }

    #
    # Get & Set
    #

    public function getID()
    {
        return $this->id;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getAnswerID()
    {
        return $this->answerID;
    }

    public function setAnswerID(int $answerID)
    {
        $this->answerID = $answerID;
    }

    public function getOpcodes()
    {
        return $this->opcodes;
    }

    public function setOpcodes(string $opcodes)
    {
        $this->opcodes = $opcodes;
    }

    public function getBaseText()
    {
        return $this->baseText;
    }

    public function setBaseText(string $baseText)
    {
        $this->baseText = $baseText;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getParentID()
    {
        return $this->parentID;
    }

    public function setParentID(int $parentID)
    {
        $this->parentID = $parentID;
    }

    public function setUserID(int $userID)
    {
        $this->userID = $userID;
    }

    public function getUserID()
    {
        return $this->userID;
    }


    #
    # Supplementary methods
    #

    public function getUserContribution(): int
    {
        $insertions = $this->getUserInsertions();
        $deletions = $this->getUserDeletions();

        return $insertions + $deletions;
    }

    public function getUserInsertions(): int
    {
        $opcodes_string = $this->getOpcodes();

        $insertions = 0;
        preg_match_all("/i(\d+)/u", $opcodes_string, $matches);
        if ($matches) {
            foreach ($matches[1] as $m) {
                $insertions = $insertions + (int) $m;
            }
        }

        return $insertions;
    }

    public function getUserDeletions(): int
    {
        $opcodes_string = $this->getOpcodes();

        $deletions = 0;
        preg_match_all("/d(\d+)/u", $opcodes_string, $matches);
        if ($matches) {
            foreach ($matches[1] as $m) {
                $deletions += (int) $m;
            }
        }

        return $deletions;
    }
}
