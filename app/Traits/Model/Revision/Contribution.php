<?php

namespace Traits\Model\Revision;

trait Contribution
{
    public function get_user_contribution(): int
    {
        $insertions = $this->get_user_insertions();
        $deletions = $this->get_user_deletions();

        return $insertions + $deletions;
    }

    public function get_user_insertions(): int
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

    public function get_user_deletions(): int
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
