<?php

abstract class Abstract_Model
{
    // Force PHP to throw an error on undefined Models property

    public function __set($var, $val)
    {
        throw new Exception("Property \"$var\" doesn't exists and cannot be set.", 0);
    }

    public function __get($var)
    {
        throw new Exception("Property \"$var\" doesn't exists and cannot be get.", 0);
    }
}
