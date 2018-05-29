<?php

class Activity_Model
{
    #
    # Activity types
    #

    const F_U_FOLLOW_Q = 'F_U_FOLLOW_Q';
    const F_U_FOLLOW_H = 'F_U_FOLLOW_H';
    const F_U_FOLLOW_U = 'F_U_FOLLOW_U';
    const F_U_REPOST_Q = 'F_U_REPOST_Q';  // @TODO don`t used
    const F_U_REQUEST_A = 'F_U_REQUEST_A';  // @TODO don`t used
    const F_U_ASKED_Q = 'F_U_ASKED_Q';
    const U_RENAME_Q = 'U_RENAME_Q';
    const F_U_UPDATE_A = 'F_U_UPDATE_A';
    const U_UPDATE_SIGNATURE = 'U_UPDATE_SIGNATURE';
    const F_U_GOT_ACHIEVEMENT = 'F_U_GOT_ACHIEVEMENT'; // @TODO don`t used
    const Q_RENAMED_BY_U = 'Q_RENAMED_BY_U';

    const F_H_ADDED_Q = 'F_H_ADDED_Q';

    const F_Q_UPDATE_A = 'F_Q_UPDATE_A';

    // Activity properties ----------------------------------------------------

    private $id;
    private $type;
    private $subject;
    private $data;

    // Getters & setters ------------------------------------------------------

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
