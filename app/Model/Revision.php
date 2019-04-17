<?php

class Revision_Model extends Abstract_Model
{
    public $id;
    public $answerID;
    public $opcodes;
    public $baseText;
    public $comment;
    public $parentID;
    public $userID;
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
        $opcodes_string = $this->opcodes;

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
        $opcodes_string = $this->opcodes;

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
