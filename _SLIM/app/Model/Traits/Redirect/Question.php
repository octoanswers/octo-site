<?php

namespace Model\Traits\Redirect;

trait Question
{
    public static function initWithDBState(array $state): self
    {
        $redirect          = new self;
        $redirect->fromID  = (int) $state['rd_from'];
        $redirect->toTitle = (string) $state['rd_title'];

        return $redirect;
    }
}
