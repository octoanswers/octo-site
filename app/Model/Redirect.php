<?php

class Redirect_Model
{
    private $fromID;
    private $toTitle;

    #
    # Init methods
    #

    public static function initWithDBState(array $state): Redirect_Model
    {
        $redirect = new self();
        $redirect->fromID = (int) $state['rd_from'];
        $redirect->toTitle = $state['rd_title'];

        return $redirect;
    }

    // Getters & setters ------------------------------------------------------

    public function getFromID()
    {
        return $this->fromID;
    }

    public function setFromID(int $fromID)
    {
        $this->fromID = $fromID;
    }

    public function getRedirectTitle()
    {
        return $this->toTitle;
    }

    public function setRedirectTitle(string $toTitle)
    {
        $this->toTitle = $toTitle;
    }
}
