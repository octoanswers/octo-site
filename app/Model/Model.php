<?php

namespace Model;

use Exception;

/**
 * Class Model.
 *
 * @property void foo_bar() <- for tests use
 */
abstract class Model
{
    /**
     * Force PHP to throw an error on undefined Models property.
     *
     * @param $var
     * @param $val
     *
     * @throws Exception
     */
    public function __set($var, $val)
    {
        throw new Exception("Property \"$var\" doesn't exists and cannot be set.", 0);
    }

    /**
     * @param $var
     *
     * @throws Exception
     */
    public function __get($var)
    {
        throw new Exception("Property \"$var\" doesn't exists and cannot be get.", 0);
    }
}
