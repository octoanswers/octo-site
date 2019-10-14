<?php

namespace Test\Validator\Redirect\Category\validate;

class ToTitleTest extends \PHPUnit\Framework\TestCase
{
    public function test__Title_not_set()
    {
        $redirect = new \Model\Redirect\Category();
        $redirect->from_ID = 7;

        $this->expectExceptionMessage('\Model\Redirect\Category property "to_title" null must be a string');
        $this->assertEquals(true, \Validator\Redirect\Category::validate($redirect));
    }

    public function test__Title_is_empty()
    {
        $redirect = new \Model\Redirect\Category();
        $redirect->from_ID = 7;
        $redirect->to_title = '';

        $this->expectExceptionMessage('\Model\Redirect\Category property "to_title" "" must have a length between 3 and 255');
        $this->assertEquals(true, \Validator\Redirect\Category::validate($redirect));
    }

    public function test__Comment_too_short()
    {
        $redirect = new \Model\Redirect\Category();
        $redirect->from_ID = 12;
        $redirect->to_title = 'x?';

        $this->expectExceptionMessage('\Model\Redirect\Category property "to_title" "x?" must have a length between 3 and 255');
        $this->assertEquals(true, \Validator\Redirect\Category::validate($redirect));
    }

    public function test__Comment_too_long()
    {
        $redirect = new \Model\Redirect\Category();
        $redirect->from_ID = 7;
        $redirect->to_title = 'Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42.';

        $this->expectExceptionMessage('\Model\Redirect\Category property "to_title" "Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42. Title42." must have a length between 3 and 255');
        $this->assertEquals(true, \Validator\Redirect\Category::validate($redirect));
    }
}
