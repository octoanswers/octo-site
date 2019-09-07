<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Category_Redirect_Validator
{
    const TITLE_MIN_LENGHT = 3;
    const TITLE_MAX_LENGHT = 255;

    //
    // Model validator
    //

    public static function validate(Category_Redirect_Model $redirect)
    {
        self::validateFromID($redirect->from_ID);
        self::validateToTitle($redirect->to_title);

        return true;
    }

    //
    // Property validators
    //

    public static function validateFromID($from_ID)
    {
        try {
            v::intType()->min(1, true)->assert($from_ID);
        } catch (NestedValidationException $exception) {
            throw new Exception('Category_Redirect_Model property "fromID" ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateToTitle($to_title)
    {
        try {
            v::stringType()->length(self::TITLE_MIN_LENGHT, self::TITLE_MAX_LENGHT, null)->assert($to_title);
        } catch (NestedValidationException $exception) {
            throw new Exception('Category_Redirect_Model property "to_title" ' . $exception->getMessages()[0], 0);
        }
    }
}
