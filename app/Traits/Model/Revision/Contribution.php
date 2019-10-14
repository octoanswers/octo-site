<?php

namespace Traits\Model\Revision;

trait Contribution
{
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
