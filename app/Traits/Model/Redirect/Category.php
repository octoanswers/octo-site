<?php

trait Category_Redirect_Model_Trait
{
    public static function init_with_DB_state(array $state): self
    {
        $redirect = new self();
        $redirect->from_ID = (int) $state['rd_from'];
        $redirect->to_title = (string) $state['rd_title'];

        return $redirect;
    }
}
