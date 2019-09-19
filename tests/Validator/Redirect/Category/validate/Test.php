<?php

class Validator_Redirect_Category__validateTest extends PHPUnit\Framework\TestCase
{
    public function test__Validate_exists_category_with_full_params()
    {
        $redirect = new \Model\Redirect\Category();
        $redirect->from_ID = 12;
        $redirect->to_title = 'iPhone 8';

        $this->assertEquals(true, Category_Redirect_Validator::validate($redirect));
    }
}
