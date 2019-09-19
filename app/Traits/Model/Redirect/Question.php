<?php

namespace Traits\Model\Redirect;

trait Question
{
    public static function init_with_DB_state(array $state): self
    {
        $redirect = new self();
        $redirect->fromID = (int) $state['rd_from'];
        $redirect->toTitle = (string) $state['rd_title'];

        return $redirect;
    }
}
