<?php

class Question_Redirect_Model extends Abstract_Model
{
    public $fromID; // int
    public $toTitle; // string

    #
    # Init methods
    #

    public static function initWithDBState(array $state): Question_Redirect_Model
    {
        $redirect = new self();
        $redirect->fromID = (int) $state['rd_from'];
        $redirect->toTitle = (string) $state['rd_title'];

        return $redirect;
    }
}
