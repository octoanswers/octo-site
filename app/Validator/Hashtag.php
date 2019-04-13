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

    public static function validateNew(Topic_Model $topic)
    {
        return self::validate($topic, false);
    }

    public static function validateExists(Topic_Model $topic)
    {
        return self::validate($topic, true);
    }

    protected static function validate(Topic_Model $topic, $isExists = true)
    {
        if ($isExists) {
            self::validateID($topic->getID());
        }
        self::validateTitle($topic->getTitle());

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
            throw new Exception('Topic id param '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateTitle($title)
    {
        try {
            v::stringType()->length(self::TITLE_MIN_LENGHT, self::TITLE_MAX_LENGHT, true)->assert($title);
        } catch (NestedValidationException $exception) {
            throw new Exception('Topic title param '.$exception->getMessages()[0], 0);
        }
    }
}
