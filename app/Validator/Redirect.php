<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Redirect_Validator
{
    const TITLE_MIN_LENGHT = 3;
    const TITLE_MAX_LENGHT = 255;

    #
    # Model validator
    #

    public static function validate(Redirect_Model $redirect)
    {
        self::validateFromID($redirect->getFromID());
        self::validateToTitle($redirect->getRedirectTitle());

        return true;
    }

    #
    # Property validators
    #

    public static function validateFromID($fromID)
    {
        try {
            v::intType()->min(1, true)->assert($fromID);
        } catch (NestedValidationException $exception) {
            throw new Exception('Redirect "fromID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateToTitle($title)
    {
        try {
            v::stringType()->length(self::TITLE_MIN_LENGHT, self::TITLE_MAX_LENGHT, null)->assert($title);

            // question ending must be '?'
            $lastCharacter = substr($title, -1);
            if ($lastCharacter != '?') {
                throw new NestedValidationException('must end with a question mark', 0);
            }
        } catch (NestedValidationException $exception) {
            throw new Exception('Redirect "to_title" property '.$exception->getMessages()[0], 0);
        }
    }
}
