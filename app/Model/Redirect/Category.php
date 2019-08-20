<?php

class Category_Redirect_Model extends Abstract_Model
{
    public $fromID; // int
    public $toTitle; // string

    //
    // Init methods
    //

    public static function initWithDBState(array $state): self
    {
        $redirect = new self();
        $redirect->fromID = (int) $state['rd_from'];
        $redirect->toTitle = (string) $state['rd_title'];

        return $redirect;
    }
}
