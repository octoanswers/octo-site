<?php

namespace Model\Traits\Redirect;

trait Category
{
    public static function initWithDBState(array $state): self
    {
        $redirect           = new self;
        $redirect->from_ID  = (int) $state['rd_from'];
        $redirect->to_title = (string) $state['rd_title'];

        return $redirect;
    }
}
