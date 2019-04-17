<?php

abstract class Abstract_Model
{
    // Force PHP to throw an error on undefined Models property

    public function __set($var, $val)
    {
        trigger_error("Property \"$var\" doesn't exists and cannot be set.", E_USER_ERROR);
    }

    public function __get($var)
    {
        trigger_error("Property \"$var\" doesn't exists and cannot be get.", E_USER_ERROR);
    }
}
