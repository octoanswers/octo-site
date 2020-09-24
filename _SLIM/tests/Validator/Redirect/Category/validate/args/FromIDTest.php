<?php

namespace Test\Validator\Redirect\Category\validate;

class FromIDTest extends \PHPUnit\Framework\TestCase
{
    public function test__FromID_equal_zero()
    {
        $redirect = new \Model\Redirect\Category();
        $redirect->from_ID = 0;
        $redirect->to_title = 'iPhone 8';

        $this->expectExceptionMessage('\Model\Redirect\Category property "fromID" 0 must be greater than or equal to 1');
        \Validator\Redirect\Category::validate($redirect);
    }

    public function test__FromID_below_zero()
    {
        $redirect = new \Model\Redirect\Category();
        $redirect->from_ID = -1;
        $redirect->to_title = 'iPhone 8';

        $this->expectExceptionMessage('\Model\Redirect\Category property "fromID" -1 must be greater than or equal to 1');
        \Validator\Redirect\Category::validate($redirect);
    }
}
