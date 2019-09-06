<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Category_Validator
{
    const TITLE_MIN_LENGHT = 2;
    const TITLE_MAX_LENGHT = 127;

    //
    // Model validator
    //

    public static function validate_new(Category_Model $category)
    {
        return self::validate($category, false);
    }

    public static function validate_exists(Category_Model $category)
    {
        return self::validate($category, true);
    }

    protected static function validate(Category_Model $category, $isExists = true)
    {
        if ($isExists) {
            self::validateID($category->id);
        }
        self::validate_title($category->title);

        return true;
    }

    //
    // Property validators
    //

    public static function validateID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('Category id param ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validate_title($title)
    {
        try {
            v::stringType()->length(self::TITLE_MIN_LENGHT, self::TITLE_MAX_LENGHT, true)->assert($title);
        } catch (NestedValidationException $exception) {
            throw new Exception('Category title param ' . $exception->getMessages()[0], 0);
        }
    }
}
