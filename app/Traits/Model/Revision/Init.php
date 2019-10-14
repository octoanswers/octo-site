<?php

namespace Traits\Model\Revision;

trait Init
{
    public static function initWithDBState(array $state): self
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
}
