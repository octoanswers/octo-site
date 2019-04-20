<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Hashtag_Validator
{
    const TITLE_MIN_LENGHT = 2;
    const TITLE_MAX_LENGHT = 127;

    #
    # Model validator
    #

    public static function validateNew(Hashtag_Model $hashtag)
    {
        return self::validate($hashtag, false);
    }

    public static function validateExists(Hashtag_Model $hashtag)
    {
        return self::validate($hashtag, true);
    }

    protected static function validate(Hashtag_Model $hashtag, $isExists = true)
    {
        if ($isExists) {
            self::validateID($hashtag->id);
        }
        self::validateTitle($hashtag->title);

        return true;
    }

    #
    # Property validators
    #

    public static function validateID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('Hashtag id param '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateTitle($title)
    {
        try {
            v::stringType()->length(self::TITLE_MIN_LENGHT, self::TITLE_MAX_LENGHT, true)->assert($title);
        } catch (NestedValidationException $exception) {
            throw new Exception('Hashtag title param '.$exception->getMessages()[0], 0);
        }
    }
}
